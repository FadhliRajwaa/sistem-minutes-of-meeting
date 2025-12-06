<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Minutes of Meeting</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: #f3f4f6;
            overflow: hidden;
        }

        .split-screen {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        /* Left Side - Hero Section */
        .left-side {
            flex: 1.2;
            background: linear-gradient(135deg, #1a1c23 0%, #2c3e50 100%);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem;
            color: white;
            overflow: hidden;
        }

        .left-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('<?= base_url('images/pattern.png') ?>'); /* Optional pattern */
            opacity: 0.05;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 600px;
            animation: slideRight 0.8s ease-out;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            background: linear-gradient(to right, #fff, #a5b4fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 1.1rem;
            opacity: 0.8;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        /* Right Side - Login Form */
        .right-side {
            flex: 1;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            animation: fadeUp 0.8s ease-out 0.2s both;
        }

        .brand-logo {
            width: 60px;
            height: auto;
            margin-bottom: 1.5rem;
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

        .btn-google {
            background-color: white;
            border: 2px solid #e5e7eb;
            color: #333;
            padding: 0.8rem;
            border-radius: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
        }

        .btn-google:hover {
            background-color: #f8f9fa;
            border-color: #d1d5db;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
            color: #9ca3af;
            font-size: 0.9rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e5e7eb;
        }

        .divider span {
            padding: 0 10px;
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
                background: linear-gradient(135deg, #f3f4f6 0%, #e0e7ff 100%);
                padding: 1.5rem;
            }
            .login-container {
                background: rgba(255, 255, 255, 0.9);
                padding: 2rem;
                border-radius: 24px;
                box-shadow: 0 20px 50px rgba(0,0,0,0.08);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.8);
            }
            .mobile-logo {
                display: block !important;
                text-align: center;
                margin-bottom: 1.5rem;
            }
            .mobile-logo img {
                width: 70px;
                height: auto;
                background: white;
                padding: 12px;
                border-radius: 16px;
                box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            }
            .login-container h3 {
                font-size: 1.5rem; /* Smaller title on mobile */
            }
        }
        
        .mobile-logo {
            display: none;
        }
    </style>
</head>

<body>

<div class="split-screen">
    <!-- Left Section -->
    <div class="left-side">
        <div class="hero-content">
            <div class="d-flex align-items-center mb-4">
                <img src="<?= base_url('images/mom.png') ?>" alt="Logo" style="width: 60px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 12px; margin-right: 15px;">
                <span class="h4 mb-0 text-white-50 font-weight-light">Minutes of Meeting</span>
            </div>
            <h1 class="hero-title">Dokumentasi Rapat Yang Efisien</h1>
            <p class="hero-desc">
                Platform terpadu untuk mengelola agenda, absensi, dan notulensi rapat Anda. 
                Tingkatkan produktivitas tim dengan pencatatan yang terstruktur dan mudah diakses.
            </p>
        </div>
    </div>

    <!-- Right Section -->
    <div class="right-side">
        <div class="login-container">
            
            <!-- Mobile Logo (Only visible on mobile) -->
            <div class="mobile-logo">
                <img src="<?= base_url('images/mom.png') ?>" alt="Logo">
            </div>

            <div class="text-center mb-4">
                <h3 class="fw-bold text-dark mb-1">Selamat Datang Kembali!</h3>
                <p class="text-muted">Silakan login ke akun Anda</p>
            </div>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger rounded-3 border-0 shadow-sm mb-4 fade-in">
                    <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('message')): ?>
                <div class="alert alert-success rounded-3 border-0 shadow-sm mb-4 fade-in">
                    <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('message') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('auth/login') ?>" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    <label for="username" class="text-muted">Username</label>
                </div>
                
                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password" class="text-muted">Password</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3 shadow-sm">
                    Sign In
                </button>
            </form>

            <div class="divider">
                <span>atau masuk dengan</span>
            </div>

            <a href="<?= base_url('auth/google-login') ?>" class="btn btn-google w-100 text-decoration-none">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" width="20">
                <span>Google Account</span>
            </a>

            <div class="text-center mt-4">
                <p class="text-muted">Belum punya akun? 
                    <a href="<?= base_url('/auth/register') ?>" class="text-primary text-decoration-none fw-bold">Daftar Sekarang</a>
                </p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
