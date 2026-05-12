<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Minutes of Meeting</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ============================================
           CSS CUSTOM PROPERTIES
           ============================================ */
        :root {
            --color-primary: #0F766E;
            --color-accent: #0D9488;
            --color-primary-light: #CCFBF1;
            --color-surface: #F8FAFC;
            --color-white: #FFFFFF;
            --color-border: #E2E8F0;
            --color-text: #0F172A;
            --color-muted: #64748B;
            --color-hover-bg: #F1F5F9;

            --font-body: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            --font-heading: 'Plus Jakarta Sans', 'Inter', sans-serif;

            --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
            --ease-in-out: cubic-bezier(0.45, 0, 0.55, 1);
            --duration-fast: 0.2s;
            --duration-normal: 0.3s;

            --radius-sm: 6px;
            --radius-md: 8px;
            --radius-lg: 12px;
            --radius-xl: 16px;
            --radius-full: 9999px;

            --shadow-sm: 0 1px 3px rgba(15, 23, 42, 0.06), 0 1px 2px rgba(15, 23, 42, 0.04);
            --shadow-md: 0 4px 6px -1px rgba(15, 23, 42, 0.06), 0 2px 4px -2px rgba(15, 23, 42, 0.04);
            --shadow-lg: 0 10px 15px -3px rgba(15, 23, 42, 0.06), 0 4px 6px -4px rgba(15, 23, 42, 0.04);
            --shadow-xl: 0 20px 25px -5px rgba(15, 23, 42, 0.06), 0 8px 10px -6px rgba(15, 23, 42, 0.04);
        }

        /* ============================================
           RESET & BASE
           ============================================ */
        *, *::before, *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: var(--font-body);
            background: var(--color-white);
            color: var(--color-text);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
        }

        /* ============================================
           SPLIT SCREEN LAYOUT
           ============================================ */
        .auth-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* --- Hero Section (Left) --- */
        .auth-hero {
            flex: 1;
            background: linear-gradient(160deg, #0F766E 0%, #0D9488 40%, #14B8A6 100%);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 64px;
            color: var(--color-white);
            overflow: hidden;
        }

        /* Decorative grid pattern */
        .auth-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 1px 1px, rgba(255,255,255,0.07) 1px, transparent 0);
            background-size: 32px 32px;
        }

        /* Decorative circles */
        .auth-hero::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
            bottom: -200px;
            right: -150px;
        }

        .hero-decoration-circle {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .hero-decoration-circle:nth-child(1) {
            width: 300px;
            height: 300px;
            top: -80px;
            left: -80px;
        }

        .hero-decoration-circle:nth-child(2) {
            width: 200px;
            height: 200px;
            bottom: 60px;
            right: 40px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 480px;
        }

        .hero-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 48px;
        }

        .hero-brand-logo {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: var(--radius-md);
            padding: 6px;
            object-fit: contain;
        }

        .hero-brand-name {
            font-family: var(--font-heading);
            font-size: 0.9375rem;
            font-weight: 600;
            opacity: 0.9;
        }

        .hero-title {
            font-family: var(--font-heading);
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.15;
            margin: 0 0 20px;
            letter-spacing: -0.025em;
            color: var(--color-white);
        }

        .hero-desc {
            font-size: 1rem;
            line-height: 1.7;
            opacity: 0.85;
            margin: 0;
            font-weight: 400;
        }

        .hero-features {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .hero-feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.875rem;
            font-weight: 500;
            opacity: 0.9;
        }

        .hero-feature-icon {
            width: 28px;
            height: 28px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            flex-shrink: 0;
        }

        /* --- Form Section (Right) --- */
        .auth-form-section {
            flex: 1.2;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            background: var(--color-white);
        }

        .auth-form-container {
            width: 100%;
            max-width: 440px;
        }

        .auth-form-header {
            margin-bottom: 32px;
        }

        .auth-form-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-text);
            margin: 0 0 6px;
            letter-spacing: -0.02em;
        }

        .auth-form-header p {
            font-size: 0.875rem;
            color: var(--color-muted);
            margin: 0;
        }

        /* --- Form Controls --- */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label-custom {
            display: block;
            font-size: 0.8125rem;
            font-weight: 500;
            color: var(--color-text);
            margin-bottom: 6px;
        }

        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--color-border);
            border-radius: var(--radius-md);
            font-family: var(--font-body);
            font-size: 0.875rem;
            color: var(--color-text);
            background: var(--color-white);
            transition:
                border-color var(--duration-fast) var(--ease-in-out),
                box-shadow var(--duration-fast) var(--ease-in-out);
            outline: none;
        }

        .form-input::placeholder {
            color: #94A3B8;
        }

        .form-input:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
        }

        /* --- Password Row Grid --- */
        .form-row-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        /* --- Buttons --- */
        .btn-auth-primary {
            width: 100%;
            padding: 11px 20px;
            border: none;
            border-radius: var(--radius-md);
            background: var(--color-primary);
            color: var(--color-white);
            font-family: var(--font-body);
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition:
                background-color var(--duration-fast) var(--ease-in-out),
                transform var(--duration-fast) var(--ease-in-out),
                box-shadow var(--duration-fast) var(--ease-in-out);
        }

        .btn-auth-primary:hover {
            background: #115E59;
            box-shadow: 0 2px 8px rgba(15, 118, 110, 0.25);
        }

        .btn-auth-primary:active {
            transform: scale(0.99);
        }

        /* --- Alert --- */
        .auth-alert {
            padding: 12px 14px;
            border-radius: var(--radius-md);
            font-size: 0.8125rem;
            font-weight: 500;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.4s var(--ease-out);
        }

        .auth-alert-error {
            background: #FEF2F2;
            color: #991B1B;
            border: 1px solid #FECACA;
        }

        .auth-alert-success {
            background: #F0FDF4;
            color: #166534;
            border: 1px solid #BBF7D0;
        }

        .auth-alert i {
            font-size: 0.875rem;
            flex-shrink: 0;
        }

        /* --- Footer Link --- */
        .auth-footer {
            text-align: center;
            margin-top: 28px;
            font-size: 0.8125rem;
            color: var(--color-muted);
        }

        .auth-footer a {
            color: var(--color-primary);
            text-decoration: none;
            font-weight: 600;
            transition: color var(--duration-fast) var(--ease-in-out);
        }

        .auth-footer a:hover {
            color: #115E59;
        }

        /* --- Mobile Logo --- */
        .mobile-brand {
            display: none;
            text-align: center;
            margin-bottom: 32px;
        }

        .mobile-brand img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            margin-bottom: 12px;
        }

        .mobile-brand h3 {
            font-family: var(--font-heading);
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--color-text);
            margin: 0;
        }

        /* ============================================
           ANIMATIONS
           ============================================ */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s var(--ease-out) both;
        }

        .animate-slide-in {
            animation: slideInLeft 0.7s var(--ease-out) both;
        }

        .animate-delay-1 { animation-delay: 0.1s; }
        .animate-delay-2 { animation-delay: 0.2s; }
        .animate-delay-3 { animation-delay: 0.3s; }

        /* ============================================
           RESPONSIVE
           ============================================ */
        @media (max-width: 992px) {
            .auth-hero {
                display: none;
            }

            .auth-form-section {
                background: var(--color-surface);
                padding: 24px 20px;
                min-height: 100vh;
            }

            .auth-form-container {
                background: var(--color-white);
                padding: 32px 24px;
                border-radius: var(--radius-xl);
                box-shadow: var(--shadow-lg);
                border: 1px solid var(--color-border);
            }

            .mobile-brand {
                display: block;
            }

            .auth-form-header h2 {
                font-size: 1.25rem;
                text-align: center;
            }

            .auth-form-header p {
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            .form-row-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }

        @media (max-width: 480px) {
            .auth-form-container {
                padding: 24px 20px;
            }

            .auth-form-header h2 {
                font-size: 1.125rem;
            }

            .auth-form-header p {
                font-size: 0.8125rem;
            }
        }
    </style>
</head>

<body>

<div class="auth-wrapper">
    <!-- Hero Section -->
    <div class="auth-hero">
        <div class="hero-decoration-circle"></div>
        <div class="hero-decoration-circle"></div>

        <div class="hero-content animate-slide-in">
            <div class="hero-brand">
                <img src="<?= base_url('images/mom.png') ?>" alt="Logo" class="hero-brand-logo">
                <span class="hero-brand-name">Minutes of Meeting</span>
            </div>

            <h1 class="hero-title">Bergabung<br>Bersama Kami</h1>
            <p class="hero-desc">
                Buat akun untuk mulai mengelola rapat secara digital.
                Catat agenda, kelola peserta, dan arsipkan notulensi dalam satu platform terpadu.
            </p>

            <div class="hero-features animate-fade-in animate-delay-3">
                <div class="hero-feature-item">
                    <div class="hero-feature-icon"><i class="fa-solid fa-check"></i></div>
                    <span>Kelola rapat dengan lebih profesional</span>
                </div>
                <div class="hero-feature-item">
                    <div class="hero-feature-icon"><i class="fa-solid fa-check"></i></div>
                    <span>Akses fitur absensi dan notulensi</span>
                </div>
                <div class="hero-feature-item">
                    <div class="hero-feature-icon"><i class="fa-solid fa-check"></i></div>
                    <span>Export laporan dalam format PDF</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="auth-form-section">
        <div class="auth-form-container animate-fade-in animate-delay-1">

            <!-- Mobile Brand -->
            <div class="mobile-brand">
                <img src="<?= base_url('images/mom.png') ?>" alt="Logo">
                <h3>Minutes of Meeting</h3>
            </div>

            <!-- Header -->
            <div class="auth-form-header">
                <h2>Buat Akun Baru</h2>
                <p>Lengkapi data berikut untuk mendaftar</p>
            </div>

            <!-- Flash Messages -->
            <?php if(session()->getFlashdata('error')): ?>
                <div class="auth-alert auth-alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('message')): ?>
                <div class="auth-alert auth-alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span><?= session()->getFlashdata('message') ?></span>
                </div>
            <?php endif; ?>

            <!-- Register Form -->
            <form action="<?= base_url('/auth/register') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="name" class="form-label-custom">Nama Lengkap</label>
                    <input type="text" class="form-input" id="name" name="name" placeholder="Masukkan nama lengkap" value="<?= old('name') ?>" required autofocus>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label-custom">Alamat Email</label>
                    <input type="email" class="form-input" id="email" name="email" placeholder="Masukkan alamat email" value="<?= old('email') ?>" required>
                </div>

                <div class="form-row-grid">
                    <div class="form-group">
                        <label for="password" class="form-label-custom">Password</label>
                        <input type="password" class="form-input" id="password" name="password" placeholder="Min. 8 karakter" required>
                    </div>

                    <div class="form-group">
                        <label for="password_confirm" class="form-label-custom">Konfirmasi Password</label>
                        <input type="password" class="form-input" id="password_confirm" name="password_confirm" placeholder="Ulangi password" required>
                    </div>
                </div>

                <button type="submit" class="btn-auth-primary">
                    Daftar Akun
                </button>
            </form>

            <!-- Footer -->
            <div class="auth-footer">
                Sudah punya akun? <a href="<?= base_url('/auth/login') ?>">Login di sini</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
