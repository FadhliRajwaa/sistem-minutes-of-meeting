<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Minutes of Meeting</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: #f3f4f6;
            overflow-x: hidden;
        }

        .split-screen {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* Left Side - Hero Section */
        .left-side {
            flex: 1;
            background: linear-gradient(135deg, #224abe 0%, #4e73df 100%);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem;
            color: white;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 600px;
            animation: slideRight 0.8s ease-out;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-desc {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        /* Right Side - Register Form */
        .right-side {
            flex: 1.2;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
        }

        .register-container {
            width: 100%;
            max-width: 500px;
            animation: fadeUp 0.8s ease-out 0.2s both;
        }

        .form-floating > .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 1rem 0.75rem;
            height: auto;
            font-size: 0.95rem;
        }

        .form-floating > .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 4px rgba(78, 115, 223, 0.1);
        }

        .btn-primary {
            background-color: #4e73df;
            border: none;
            padding: 0.8rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.3);
        }

        /* Animations */
        @keyframes slideRight {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .left-side {
                display: none;
            }
            .right-side {
                background: #f3f4f6;
                height: 100vh;
            }
            .register-container {
                background: white;
                padding: 2.5rem;
                border-radius: 20px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            }
        }
    </style>
</head>
<body>

<div class="split-screen">
    <!-- Left Section -->
    <div class="left-side">
        <div class="hero-content">
            <div class="d-flex align-items-center mb-4">
                <img src="<?= base_url('images/mom.png') ?>" alt="Logo" style="width: 50px; background: rgba(255,255,255,0.2); padding: 8px; border-radius: 10px; margin-right: 15px;">
                <span class="h5 mb-0 text-white fw-normal">Minutes of Meeting</span>
            </div>
            <h1 class="hero-title">Bergabung Bersama Kami</h1>
            <p class="hero-desc">
                Buat akun baru untuk mulai mengelola rapat Anda dengan lebih profesional. 
                Dapatkan akses penuh ke fitur manajemen jadwal, absensi digital, dan ekspor laporan otomatis.
            </p>
        </div>
    </div>

    <!-- Right Section -->
    <div class="right-side">
        <div class="register-container">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-dark mb-1">Buat Akun Baru</h3>
                <p class="text-muted">Lengkapi data berikut untuk mendaftar</p>
            </div>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger rounded-3 border-0 shadow-sm mb-4">
                    <i class="fas fa-exclamation-triangle me-2"></i> <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('/auth/register') ?>" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" required autofocus>
                    <label for="name" class="text-muted">Nama Lengkap</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                    <label for="email" class="text-muted">Alamat Email</label>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <label for="password" class="text-muted">Password</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm Password" required>
                            <label for="password_confirm" class="text-muted">Konfirmasi Password</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3 shadow-sm py-3">
                    Daftar Akun
                </button>
            </form>

            <div class="text-center mt-4">
                <p class="text-muted">Sudah punya akun? 
                    <a href="<?= base_url('/auth/login') ?>" class="text-primary text-decoration-none fw-bold">Login di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
