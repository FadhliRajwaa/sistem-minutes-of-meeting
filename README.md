# Minutes of Meeting System

Aplikasi web untuk mengelola notulensi rapat, peserta, dan absensi digital dengan fitur barcode scanning. Dibangun menggunakan CodeIgniter 4, Bootstrap 5, dan MySQL.

## Fitur Utama

### Authentication & Multi-Entity
- Login manual (username/email + password)
- Login via Google OAuth2
- Register akun baru
- **Data isolation per user** - setiap user hanya bisa melihat dan mengelola data miliknya sendiri
- Auth middleware melindungi semua route (kecuali login/register)

### Manajemen Meeting
- Buat, edit, dan hapus jadwal rapat
- Status otomatis (Belum Mulai / Selesai) berdasarkan waktu
- Reminder meeting terdekat di dashboard

### Manajemen Peserta & Absensi Digital
- Tambah peserta per meeting dengan Barcode ID unik
- **Scan barcode/QR code** via kamera untuk absensi real-time
- Status kehadiran otomatis terupdate dengan timestamp
- Validasi duplikasi barcode dan feedback yang jelas

### Notulensi / Diskusi
- Form notulensi dengan multi-poin pembahasan (dynamic add/remove)
- Pencarian diskusi berdasarkan topik, notulis, atau tanggal
- Data tersimpan dalam format JSON untuk fleksibilitas

### Export PDF
- Generate notulen rapat dalam format PDF profesional
- Preview HTML sebelum download
- Template PDF dengan header, daftar hadir, poin pembahasan, dan tanda tangan

## Tech Stack

| Layer | Teknologi |
|-------|-----------|
| Backend | PHP 8.1+, CodeIgniter 4.6 |
| Frontend | Bootstrap 5.3, jQuery 3.7, Font Awesome 6.5 |
| Database | MySQL (XAMPP local / Aiven Cloud SSL) |
| PDF | Dompdf 3.1 |
| OAuth | Google API Client 2.18 |
| Barcode | html5-qrcode (camera-based scanner) |
| Deployment | Vercel (vercel-php runtime) |
| Font | Inter + Plus Jakarta Sans (Google Fonts) |

## Database Schema

```
users (12 kolom)
├── id (PK, AUTO_INCREMENT)
├── username, email, password, role (admin/peserta), foto
└── created_at, updated_at

meetings (8 kolom)
├── id (PK), user_id (FK → users.id)
├── nama_meeting, tanggal, tempat, status
└── created_at, updated_at

participants (9 kolom)
├── id (PK), user_id (FK → users.id), meeting_id (FK → meetings.id)
├── name, barcode_id (UNIQUE per meeting), status (hadir/belum_hadir)
└── scanned_at, created_at, updated_at

discussions (9 kolom)
├── id (PK), user_id (FK → users.id), meeting_id (FK → meetings.id)
├── topik, pembahasan (JSON), tanggal, nama_notulis
└── created_at, updated_at
```

## Arsitektur

```
┌─────────────────────────────────────────────────┐
│                   Browser                        │
│  (Bootstrap 5 + jQuery + html5-qrcode)          │
└──────────────────────┬──────────────────────────┘
                       │ AJAX (JSON)
┌──────────────────────▼──────────────────────────┐
│              CodeIgniter 4 (PHP)                  │
│                                                  │
│  ┌─────────┐  ┌────────────┐  ┌──────────────┐ │
│  │ AuthFilter│  │ Controllers │  │    Models    │ │
│  │(Middleware)│  │  (9 files)  │  │  (4 files)  │ │
│  └─────────┘  └────────────┘  └──────────────┘ │
│                                                  │
│  SPA Architecture: Layout + AJAX Partial Loading │
└──────────────────────┬──────────────────────────┘
                       │ MySQLi
┌──────────────────────▼──────────────────────────┐
│              MySQL Database                       │
│  (Local XAMPP / Aiven Cloud SSL)                 │
└─────────────────────────────────────────────────┘
```

## Setup & Installation

### Requirements
- PHP 8.1+ dengan extensions: intl, mbstring, mysqli, gd
- MySQL 5.7+ atau MariaDB 10.4+
- Composer

### Langkah Instalasi

```bash
# 1. Clone repository
git clone <repo-url>
cd minutes-meeting

# 2. Install dependencies
composer install

# 3. Setup environment
cp .env.example .env
# Edit .env sesuai konfigurasi database lokal

# 4. Buat database
# Buat database bernama "minuts-meeting" di MySQL

# 5. Jalankan migration
php spark migrate

# 6. (Opsional) Seed data admin
php spark db:seed UserSeeder

# 7. Jalankan server
php spark serve --port 8080

# 8. Buka browser
# http://localhost:8080
```

### Environment Variables (.env)

```env
# App
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'

# Database (Local)
database.default.hostname = localhost
database.default.database = minuts-meeting
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306

# Database (Cloud - Aiven)
# DATABASE_DEFAULT_GROUP = aiven
# AIVEN_PASSWORD = your_aiven_password

# Google OAuth
GOOGLE_CLIENT_ID = 'your_google_client_id'
GOOGLE_CLIENT_SECRET = 'your_google_client_secret'
GOOGLE_REDIRECT_URI = 'http://localhost:8080/auth/google-callback'
```

## Struktur Direktori

```
minutes-meeting/
├── app/
│   ├── Config/          # Routes, Database, Filters, Google OAuth
│   ├── Controllers/     # 9 controllers (Auth, Main, Meeting, dll)
│   ├── Database/
│   │   ├── Migrations/  # 6 migration files
│   │   └── Seeds/       # UserSeeder (admin default)
│   ├── Filters/         # AuthFilter (middleware proteksi route)
│   ├── Models/          # 4 models (User, Meeting, Discussion, Participant)
│   └── Views/
│       ├── Layouts/     # main.php (SPA shell)
│       ├── auth/        # login.php, register.php
│       ├── partials/    # 5 partial views (AJAX loaded)
│       └── pdf/         # Template PDF (Dompdf)
├── public/
│   ├── css/             # Bootstrap 5.3.3
│   ├── js/              # jQuery, Bootstrap Bundle
│   └── images/          # Logo, assets
├── api/                 # Vercel serverless entry point
├── vercel.json          # Vercel deployment config
├── composer.json        # PHP dependencies
└── .env                 # Environment config (not committed)
```

## API Endpoints

### Authentication (Public)
| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/auth/login` | Halaman login |
| POST | `/auth/login` | Proses login |
| GET | `/auth/register` | Halaman register |
| POST | `/auth/register` | Proses register |
| GET | `/auth/google-login` | Redirect ke Google OAuth |
| GET | `/auth/google-callback` | Callback dari Google |
| GET | `/auth/logout` | Logout & destroy session |

### Dashboard & Partials (Protected)
| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/dashboard` | SPA shell utama |
| GET | `/partials/{page}-content` | Load partial view via AJAX |

### Meeting API (Protected)
| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/v1/meetings` | List semua meeting user |
| POST | `/meeting/save` | Buat meeting baru |
| POST | `/meeting/update` | Update meeting |
| POST | `/meeting/delete` | Hapus meeting + cascade |
| GET | `/v1/reminder` | Meeting terdekat (upcoming) |

### Participant API (Protected)
| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/v1/participants/{meetingId}` | List peserta per meeting |
| POST | `/v1/participants` | Tambah peserta baru |
| POST | `/participant/absen` | Absensi via barcode scan |

### Discussion API (Protected)
| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| POST | `/discussion/save` | Simpan notulensi |
| GET | `/discussion/search` | Cari diskusi |
| POST | `/discussion/delete` | Hapus diskusi |

### Export (Protected)
| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/export/pdf/{id}` | Download PDF |
| GET | `/export/preview/{id}` | Preview HTML |

## Deployment (Vercel)

Project ini dikonfigurasi untuk deploy ke Vercel menggunakan `vercel-php` runtime.

```bash
# Set environment variables di Vercel Dashboard:
DATABASE_DEFAULT_GROUP=aiven
AIVEN_PASSWORD=your_password
GOOGLE_CLIENT_ID=your_id
GOOGLE_CLIENT_SECRET=your_secret
GOOGLE_REDIRECT_URI=https://your-domain.vercel.app/auth/google-callback
```

## Default Login

Setelah menjalankan `UserSeeder`:
- **Username:** admin
- **Email:** admin@admin.com
- **Password:** admin123
- **Role:** admin

## License

MIT License
