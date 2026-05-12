<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Minutes of Meeting</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 -->
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Font Awesome 6.5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ============================================
           DESIGN TOKENS
           ============================================ */
        :root {
            --color-primary: #0F766E;
            --color-accent: #0D9488;
            --color-surface: #F8FAFC;
            --color-white: #FFFFFF;
            --color-border: #E2E8F0;
            --color-text: #0F172A;
            --color-muted: #64748B;

            --font-body: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            --font-heading: 'Plus Jakarta Sans', 'Inter', sans-serif;
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
        }

        /* ============================================
           SPLIT SCREEN LAYOUT
           ============================================ */
        .split-screen {
            display: flex;
            min-height: 100vh;
        }

        /* ============================================
           LEFT SIDE - Hero
           ============================================ */
        .left-side {
            flex: 1.2;
            background: linear-gradient(160deg, #0F766E 0%, #0D9488 50%, #14B8A6 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px;
            overflow: hidden;
        }

        /* Dot grid pattern */
        .left-side::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 28px 28px;
            z-index: 1;
        }

        /* Decorative glow */
        .left-side::after {
            content: '';
            position: absolute;
            width: 480px;
            height: 480px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.035);
            bottom: -180px;
            right: -140px;
            z-index: 1;
        }

        .left-content {
            position: relative;
            z-index: 2;
            max-width: 520px;
            color: var(--color-white);
            animation: slideIn 0.6s ease-out both;
        }

        /* Brand */
        .left-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 48px;
        }

        .left-brand img {
            width: 48px;
            height: 48px;
            background: var(--color-white);
            border-radius: 10px;
            padding: 8px;
            object-fit: contain;
        }

        .left-brand span {
            font-family: var(--font-heading);
            font-size: 0.9375rem;
            font-weight: 700;
            color: var(--color-white);
            opacity: 0.95;
        }

        /* Title */
        .left-title {
            font-family: var(--font-heading);
            font-size: 2.75rem;
            font-weight: 800;
            line-height: 1.15;
            color: var(--color-white);
            margin: 0 0 20px;
            letter-spacing: -0.02em;
        }

        /* Description */
        .left-desc {
            font-size: 1.05rem;
            line-height: 1.7;
            opacity: 0.85;
            margin: 0;
            font-weight: 400;
        }

        /* Feature list */
        .left-features {
            margin-top: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .left-feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.9rem;
            font-weight: 500;
            opacity: 0.92;
        }

        .left-feature-icon {
            width: 20px;
            height: 20px;
            background: var(--color-white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .left-feature-icon i {
            font-size: 0.5rem;
            color: var(--color-primary);
        }

        /* ============================================
           RIGHT SIDE - Form
           ============================================ */
        .right-side {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            background: var(--color-white);
        }

        .login-container {
            max-width: 400px;
            width: 100%;
            animation: fadeUp 0.5s ease-out 0.15s both;
        }

        /* Mobile brand - hidden on desktop */
        .mobile-brand {
            display: none;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .mobile-brand img {
            width: 52px;
            height: 52px;
            background: var(--color-white);
            padding: 10px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(15, 23, 42, 0.08);
            object-fit: contain;
            margin-bottom: 10px;
        }

        .mobile-brand h3 {
            font-family: var(--font-heading);
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--color-text);
            margin: 0;
        }

        /* Form header */
        .login-header {
            margin-bottom: 28px;
        }

        .login-header h2 {
            font-family: var(--font-heading);
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-text);
            margin: 0 0 6px;
            letter-spacing: -0.01em;
        }

        .login-header p {
            font-size: 0.9rem;
            color: var(--color-muted);
            margin: 0;
            line-height: 1.5;
        }

        /* ============================================
           FLASH MESSAGES
           ============================================ */
        .alert-flash {
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 0.8125rem;
            font-weight: 500;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeUp 0.4s ease-out both;
        }

        .alert-flash i {
            font-size: 0.875rem;
            flex-shrink: 0;
        }

        .alert-error {
            background: #FEF2F2;
            color: #991B1B;
            border: 1px solid #FECACA;
        }

        .alert-success {
            background: #F0FDF4;
            color: #166534;
            border: 1px solid #BBF7D0;
        }

        /* ============================================
           FORM CONTROLS
           ============================================ */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 500;
            color: var(--color-text);
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid var(--color-border);
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.875rem;
            color: var(--color-text);
            background: var(--color-white);
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-group input::placeholder {
            color: #94A3B8;
        }

        .form-group input:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
        }

        /* ============================================
           BUTTONS
           ============================================ */
        .btn-login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: var(--color-primary);
            color: var(--color-white);
            font-family: var(--font-body);
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-login:hover {
            background: #115E59;
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.25);
        }

        .btn-login:active {
            transform: scale(0.99);
        }

        .btn-google {
            width: 100%;
            padding: 11px 20px;
            border: 1px solid var(--color-border);
            border-radius: 8px;
            background: var(--color-white);
            color: var(--color-text);
            font-family: var(--font-body);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        .btn-google:hover {
            background: var(--color-surface);
            border-color: #CBD5E1;
            color: var(--color-text);
        }

        .btn-google img {
            width: 18px;
            height: 18px;
        }

        /* ============================================
           DIVIDER
           ============================================ */
        .auth-divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 24px 0;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--color-border);
        }

        .auth-divider span {
            font-size: 0.75rem;
            color: var(--color-muted);
            font-weight: 500;
            white-space: nowrap;
        }

        /* ============================================
           FOOTER LINK
           ============================================ */
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
            transition: color 0.2s ease;
        }

        .auth-footer a:hover {
            color: #115E59;
        }

        /* ============================================
           ANIMATIONS
           ============================================ */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ============================================
           RESPONSIVE
           ============================================ */
        @media (max-width: 992px) {
            .left-side {
                display: none;
            }

            .right-side {
                background: linear-gradient(180deg, #F8FAFC, #F1F5F9);
                padding: 24px 20px;
                min-height: 100vh;
            }

            .login-container {
                background: var(--color-white);
                padding: 2rem;
                border-radius: 16px;
                box-shadow: 0 4px 24px rgba(15, 23, 42, 0.06), 0 1px 3px rgba(15, 23, 42, 0.04);
                border: 1px solid var(--color-border);
            }

            .mobile-brand {
                display: block;
                text-align: center;
                margin-bottom: 1.5rem;
            }

            .login-header h2 {
                text-align: center;
            }

            .login-header p {
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1.5rem;
            }

            .login-header h2 {
                font-size: 1.25rem;
            }
        }
    </style>
</head>

<body>

<div class="split-screen">

    <!-- ==========================================
         LEFT SIDE - Hero
         ========================================== -->
    <div class="left-side">
        <div class="left-content">

            <!-- Brand -->
            <div class="left-brand">
                <img src="<?= base_url('images/mom.png') ?>" alt="Logo">
                <span>Minutes of Meeting</span>
            </div>

            <!-- Title -->
            <h1 class="left-title">Dokumentasi Rapat<br>Yang Efisien</h1>

            <!-- Description -->
            <p class="left-desc">
                Platform terpadu untuk mengelola agenda, mencatat kehadiran, dan mendokumentasikan hasil rapat secara terstruktur. Tingkatkan produktivitas tim Anda.
            </p>

            <!-- Features -->
            <div class="left-features">
                <div class="left-feature-item">
                    <div class="left-feature-icon">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <span>Manajemen jadwal rapat terpusat</span>
                </div>
                <div class="left-feature-item">
                    <div class="left-feature-icon">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <span>Absensi digital dengan barcode</span>
                </div>
                <div class="left-feature-item">
                    <div class="left-feature-icon">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <span>Export laporan otomatis ke PDF</span>
                </div>
            </div>

        </div>
    </div>

    <!-- ==========================================
         RIGHT SIDE - Login Form
         ========================================== -->
    <div class="right-side">
        <div class="login-container">

            <!-- Mobile Brand -->
            <div class="mobile-brand">
                <img src="<?= base_url('images/mom.png') ?>" alt="Logo">
                <h3>Minutes of Meeting</h3>
            </div>

            <!-- Header -->
            <div class="login-header">
                <h2>Selamat Datang</h2>
                <p>Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert-flash alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('message')): ?>
                <div class="alert-flash alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span><?= session()->getFlashdata('message') ?></span>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="<?= base_url('auth/login') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="username">Username atau Email</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan username atau email" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn-login">Masuk</button>

            </form>

            <!-- Divider -->
            <div class="auth-divider">
                <span>atau masuk dengan</span>
            </div>

            <!-- Google Login -->
            <a href="<?= base_url('auth/google-login') ?>" class="btn-google">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google">
                <span>Masuk dengan Google</span>
            </a>

            <!-- Register Link -->
            <div class="auth-footer">
                Belum punya akun? <a href="<?= base_url('/auth/register') ?>">Daftar Sekarang</a>
            </div>

        </div>
    </div>

</div>

</body>
</html>
