<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title><?= $title ?? 'Minutes of Meeting' ?></title>

    <!-- CSRF Token Meta -->
    <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">

    <!-- Preconnect & Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ==========================================================
           CSS DESIGN SYSTEM — Minutes of Meeting
           ========================================================== */
        :root {
            --c-primary: #0F766E;
            --c-primary-hover: #0D5E57;
            --c-accent: #0D9488;
            --c-primary-10: rgba(15, 118, 110, 0.08);
            --c-primary-20: rgba(15, 118, 110, 0.16);

            --c-text: #0F172A;
            --c-text-muted: #64748B;
            --c-text-subtle: #94A3B8;

            --c-bg: #F8FAFC;
            --c-surface: #FFFFFF;
            --c-border: #E2E8F0;
            --c-border-strong: #CBD5E1;

            --c-danger: #EF4444;
            --c-danger-bg: #FEF2F2;
            --c-success: #10B981;
            --c-warning: #F59E0B;

            --sidebar-w: 260px;
            --sidebar-w-collapsed: 72px;
            --topbar-h: 60px;

            --font-body: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            --font-heading: 'Plus Jakarta Sans', 'Inter', sans-serif;

            --r-sm: 6px;
            --r-md: 8px;
            --r-lg: 12px;
            --r-xl: 16px;

            --sh-sm: 0 1px 2px rgba(15, 23, 42, 0.04);
            --sh-md: 0 4px 12px rgba(15, 23, 42, 0.06);
            --sh-lg: 0 10px 30px rgba(15, 23, 42, 0.08);

            --ease: cubic-bezier(0.16, 1, 0.3, 1);
            --d: 0.22s;
        }

        /* ==========================================================
           RESET
           ========================================================== */
        *, *::before, *::after { box-sizing: border-box; }

        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            background: var(--c-bg);
            font-family: var(--font-body);
            color: var(--c-text);
            font-size: 0.875rem;
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            font-weight: 700;
            letter-spacing: -0.01em;
            margin: 0;
        }

        a { text-decoration: none; color: inherit; }
        button { font-family: inherit; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 10px; border: 2px solid var(--c-bg); }
        ::-webkit-scrollbar-thumb:hover { background: #94A3B8; }

        /* ==========================================================
           APP SHELL — CSS Grid Layout
           ========================================================== */
        .app-shell {
            display: grid;
            grid-template-columns: var(--sidebar-w) 1fr;
            grid-template-rows: var(--topbar-h) 1fr;
            grid-template-areas:
                "sidebar topbar"
                "sidebar main";
            min-height: 100vh;
            transition: grid-template-columns var(--d) var(--ease);
        }

        .app-shell.sidebar-collapsed {
            grid-template-columns: var(--sidebar-w-collapsed) 1fr;
        }

        /* ==========================================================
           SIDEBAR
           ========================================================== */
        .sidebar {
            grid-area: sidebar;
            background: var(--c-surface);
            border-right: 1px solid var(--c-border);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            height: 100vh;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        /* Brand */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 20px 16px;
            border-bottom: 1px solid var(--c-border);
            flex-shrink: 0;
            min-height: 76px;
        }

        .sidebar-brand-logo {
            width: 36px;
            height: 36px;
            border-radius: var(--r-md);
            object-fit: contain;
            flex-shrink: 0;
            background: var(--c-primary-10);
            padding: 4px;
        }

        .sidebar-brand-text {
            min-width: 0;
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar-brand-text h4 {
            font-size: 0.95rem;
            color: var(--c-text);
            margin: 0 0 2px;
            line-height: 1.2;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .brand-label {
            font-size: 0.65rem;
            font-weight: 600;
            color: var(--c-text-subtle);
            letter-spacing: 0.08em;
        }

        /* Close button mobile */
        .sidebar-close-mobile {
            display: none;
            position: absolute;
            top: 14px;
            right: 14px;
            width: 28px;
            height: 28px;
            border-radius: var(--r-sm);
            border: none;
            background: transparent;
            color: var(--c-text-muted);
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
        }
        .sidebar-close-mobile:hover {
            background: var(--c-bg);
            color: var(--c-text);
        }

        /* Nav */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 12px 12px 12px;
            min-height: 0;
        }

        .sidebar-nav-label {
            font-size: 0.6875rem;
            font-weight: 700;
            color: var(--c-text-subtle);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 14px 12px 8px;
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar-nav .nav {
            padding: 0;
            margin: 0;
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: var(--r-md);
            color: var(--c-text-muted);
            font-size: 0.875rem;
            font-weight: 500;
            position: relative;
            transition: background-color var(--d) var(--ease), color var(--d) var(--ease);
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar-nav .nav-link i {
            font-size: 1rem;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-nav .nav-link span {
            flex: 1;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-nav .nav-link:hover {
            background: var(--c-bg);
            color: var(--c-text);
        }

        .sidebar-nav .nav-link.active {
            background: var(--c-primary-10);
            color: var(--c-primary);
            font-weight: 600;
        }

        .sidebar-nav .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 8px;
            bottom: 8px;
            width: 3px;
            background: var(--c-primary);
            border-radius: 0 3px 3px 0;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            padding: 12px;
            border-top: 1px solid var(--c-border);
            background: var(--c-surface);
            flex-shrink: 0;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px;
            border-radius: var(--r-md);
            margin-bottom: 8px;
            transition: background-color var(--d) var(--ease);
            cursor: pointer;
            overflow: hidden;
        }
        .user-profile:hover {
            background: var(--c-bg);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--c-primary), var(--c-accent));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.875rem;
            flex-shrink: 0;
            overflow: hidden;
        }
        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-info {
            min-width: 0;
            flex: 1;
            overflow: hidden;
        }
        .user-info-name {
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--c-text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .user-info-role {
            font-size: 0.7rem;
            color: var(--c-text-muted);
            text-transform: capitalize;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 9px 12px;
            border-radius: var(--r-md);
            border: 1px solid var(--c-border);
            background: var(--c-surface);
            color: var(--c-text-muted);
            font-size: 0.8125rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color var(--d) var(--ease), color var(--d) var(--ease), border-color var(--d) var(--ease);
            white-space: nowrap;
            overflow: hidden;
        }
        .btn-logout:hover {
            background: var(--c-danger-bg);
            color: var(--c-danger);
            border-color: #FECACA;
        }
        .btn-logout i { font-size: 0.875rem; flex-shrink: 0; }

        /* Collapsed sidebar (desktop only) */
        .app-shell.sidebar-collapsed .sidebar-brand-text,
        .app-shell.sidebar-collapsed .sidebar-nav-label,
        .app-shell.sidebar-collapsed .nav-link span,
        .app-shell.sidebar-collapsed .user-info,
        .app-shell.sidebar-collapsed .btn-logout span {
            display: none;
        }
        .app-shell.sidebar-collapsed .sidebar-brand {
            justify-content: center;
            padding: 20px 12px 16px;
        }
        .app-shell.sidebar-collapsed .nav-link {
            justify-content: center;
            padding: 10px;
        }
        .app-shell.sidebar-collapsed .user-profile {
            justify-content: center;
            padding: 6px;
        }
        .app-shell.sidebar-collapsed .btn-logout {
            padding: 9px 8px;
        }

        /* ==========================================================
           TOPBAR
           ========================================================== */
        .topbar {
            grid-area: topbar;
            background: var(--c-surface);
            border-bottom: 1px solid var(--c-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 40;
            height: var(--topbar-h);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
            flex: 1;
        }

        .topbar-greeting {
            font-size: 0.8125rem;
            color: var(--c-text-muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            min-width: 0;
        }
        .topbar-greeting strong {
            color: var(--c-text);
            font-weight: 600;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .btn-toggle {
            width: 36px;
            height: 36px;
            border: 1px solid var(--c-border);
            border-radius: var(--r-md);
            background: var(--c-surface);
            color: var(--c-text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color var(--d) var(--ease), color var(--d) var(--ease), border-color var(--d) var(--ease);
            flex-shrink: 0;
            padding: 0;
        }
        .btn-toggle:hover {
            background: var(--c-bg);
            color: var(--c-text);
            border-color: var(--c-border-strong);
        }

        .topbar-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--c-primary), var(--c-accent));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.8125rem;
            flex-shrink: 0;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color var(--d) var(--ease), transform var(--d) var(--ease);
        }
        .topbar-avatar:hover {
            border-color: var(--c-primary);
            transform: scale(1.05);
        }
        .topbar-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ==========================================================
           MAIN CONTENT
           ========================================================== */
        .main-area {
            grid-area: main;
            position: relative;
            padding: 24px;
            min-width: 0;
            overflow-x: hidden;
        }

        #mainContent {
            width: 100%;
            max-width: 100%;
            opacity: 1;
            transition: opacity 0.2s var(--ease);
        }

        #mainContent.is-loading {
            opacity: 0;
            pointer-events: none;
        }

        /* ==========================================================
           SKELETON LOADER
           ========================================================== */
        .content-skeleton {
            position: absolute;
            inset: 24px;
            display: none;
            flex-direction: column;
            gap: 16px;
            z-index: 5;
            pointer-events: none;
        }
        .content-skeleton.active { display: flex; }

        .skeleton-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 8px;
        }
        .skeleton-line {
            height: 14px;
            border-radius: 6px;
            background: linear-gradient(90deg, #F1F5F9 0%, #E2E8F0 40%, #F1F5F9 80%);
            background-size: 200% 100%;
            animation: shimmer 1.4s linear infinite;
        }
        .skeleton-title { width: 200px; height: 28px; }
        .skeleton-btn {
            width: 140px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(90deg, #F1F5F9 0%, #E2E8F0 40%, #F1F5F9 80%);
            background-size: 200% 100%;
            animation: shimmer 1.4s linear infinite;
            flex-shrink: 0;
        }
        .skeleton-card {
            background: #fff;
            border: 1px solid var(--c-border);
            border-radius: var(--r-lg);
            padding: 20px;
        }
        .skeleton-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 16px;
        }

        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Page Loader Full Overlay */
        .page-loader {
            position: fixed;
            top: var(--topbar-h);
            left: var(--sidebar-w);
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 12px;
            z-index: 30;
            transition: left var(--d) var(--ease);
        }
        .page-loader.active { display: flex; }
        .app-shell.sidebar-collapsed ~ .page-loader,
        body.sidebar-is-collapsed .page-loader {
            left: var(--sidebar-w-collapsed);
        }
        .loader-spinner {
            width: 44px;
            height: 44px;
            border: 3px solid var(--c-border);
            border-top-color: var(--c-primary);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        .loader-text {
            font-size: 0.8125rem;
            color: var(--c-text-muted);
            font-weight: 500;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ==========================================================
           MOBILE OVERLAY
           ========================================================== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(3px);
            z-index: 45;
            opacity: 0;
            transition: opacity var(--d) var(--ease);
        }
        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* ==========================================================
           BOOTSTRAP OVERRIDES
           ========================================================== */
        .modal-backdrop {
            z-index: 1050 !important;
        }
        .modal {
            z-index: 1055 !important;
        }
        .toast-container,
        .position-fixed.top-0.end-0 {
            z-index: 1090 !important;
        }

        /* ==========================================================
           RESPONSIVE — Tablet & Mobile
           ========================================================== */
        @media (max-width: 991.98px) {
            .topbar-greeting { display: none; }
        }

        @media (max-width: 767.98px) {
            /* Collapse grid to single column on mobile */
            .app-shell {
                grid-template-columns: 1fr;
                grid-template-rows: var(--topbar-h) 1fr;
                grid-template-areas:
                    "topbar"
                    "main";
            }
            .app-shell.sidebar-collapsed {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                bottom: 0;
                width: min(280px, 85vw);
                z-index: 50;
                transform: translateX(-100%);
                transition: transform var(--d) var(--ease);
                height: 100vh;
            }
            .sidebar.active {
                transform: translateX(0);
                box-shadow: 4px 0 24px rgba(15, 23, 42, 0.15);
            }
            .sidebar-close-mobile { display: flex; }

            .topbar {
                padding: 0 16px;
            }

            .main-area {
                padding: 16px;
            }

            .content-skeleton {
                inset: 16px;
            }

            .page-loader {
                left: 0;
            }

        }

        @media (max-width: 380px) {
            .topbar {
                padding: 0 12px;
            }
            .main-area {
                padding: 12px;
            }
        }
    </style>
</head>

<body>

<!-- Mobile Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- App Shell (CSS Grid) -->
<div class="app-shell" id="appShell">

    <!-- ================================================
         SIDEBAR
         ================================================ -->
    <nav class="sidebar" id="sidebar">
        <button type="button" class="sidebar-close-mobile" id="sidebarClose" aria-label="Tutup sidebar">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="sidebar-brand">
            <img src="<?= site_url('images/mom.png') ?>" alt="MoM Logo" class="sidebar-brand-logo">
            <div class="sidebar-brand-text">
                <h4>Minutes of Meeting</h4>
                <span class="brand-label">DASHBOARD</span>
            </div>
        </div>

        <div class="sidebar-nav">
            <div class="sidebar-nav-label">Menu Utama</div>
            <ul class="nav">
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link" data-page="dashboard" onclick="loadContent('dashboard'); return false;">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('meetings') ?>" class="nav-link" data-page="meeting" onclick="loadContent('meeting'); return false;">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Manage Meeting</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('participants') ?>" class="nav-link" data-page="participant" onclick="loadContent('participant'); return false;">
                        <i class="fas fa-users"></i>
                        <span>Participant Input</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('discussions') ?>" class="nav-link" data-page="discussion" onclick="loadContent('discussion'); return false;">
                        <i class="fas fa-comments"></i>
                        <span>Add Discussion</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-nav-label">Export</div>
            <ul class="nav">
                <li class="nav-item">
                    <a href="<?= base_url('export') ?>" class="nav-link" data-page="export" onclick="loadContent('export'); return false;">
                        <i class="fas fa-file-pdf"></i>
                        <span>Export to PDF</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-nav-label">Akun</div>
            <ul class="nav">
                <li class="nav-item">
                    <a href="<?= base_url('settings') ?>" class="nav-link" data-page="profile" onclick="loadContent('profile'); return false;">
                        <i class="fas fa-user-gear"></i>
                        <span>Pengaturan Profil</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer">
            <?php
                $user = session()->get('user');
                $foto = $user['foto'] ?? '';
                $username = $user['username'] ?? 'User';
                $role = $user['role'] ?? 'peserta';
                $initial = strtoupper(substr($username, 0, 1));
                $isBase64Foto = !empty($foto) && strpos($foto, 'data:image/') === 0;
                $isUrlFoto = !empty($foto) && !$isBase64Foto && filter_var($foto, FILTER_VALIDATE_URL);
                $hasLocalFoto = !empty($foto) && $foto !== 'default.png' && !$isUrlFoto && !$isBase64Foto;
            ?>
            <a href="<?= base_url('settings') ?>" onclick="loadContent('profile'); return false;" class="user-profile" title="Pengaturan Profil">
                <div class="user-avatar">
                    <?php if ($isBase64Foto): ?>
                        <img src="<?= esc($foto) ?>" alt="<?= esc($username) ?>">
                    <?php elseif ($isUrlFoto): ?>
                        <img src="<?= esc($foto) ?>" alt="<?= esc($username) ?>" referrerpolicy="no-referrer">
                    <?php elseif ($hasLocalFoto): ?>
                        <img src="<?= base_url('uploads/foto/' . $foto) ?>" alt="<?= esc($username) ?>">
                    <?php else: ?>
                        <?= $initial ?>
                    <?php endif; ?>
                </div>
                <div class="user-info">
                    <div class="user-info-name"><?= esc($username) ?></div>
                    <div class="user-info-role"><?= ucfirst(esc($role)) ?></div>
                </div>
            </a>
            <form action="<?= base_url('/auth/logout') ?>" method="post" style="margin:0;padding:0;">
                <?= csrf_field() ?>
                <button type="submit" class="btn-logout" title="Logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </nav>

    <!-- ================================================
         TOPBAR
         ================================================ -->
    <header class="topbar">
        <div class="topbar-left">
            <!-- Mobile hamburger -->
            <button type="button" id="mobileToggle" class="btn-toggle d-md-none" aria-label="Buka sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>
            <!-- Desktop toggle -->
            <button type="button" id="desktopToggle" class="btn-toggle d-none d-md-flex" aria-label="Toggle sidebar">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>
            <span class="topbar-greeting">
                Selamat datang, <strong><?= esc($username) ?></strong>
            </span>
        </div>
        <div class="topbar-right">
            <a href="<?= base_url('settings') ?>" onclick="loadContent('profile'); return false;" title="Pengaturan Profil">
                <div class="topbar-avatar">
                    <?php if ($isBase64Foto): ?>
                        <img src="<?= esc($foto) ?>" alt="<?= esc($username) ?>">
                    <?php elseif ($isUrlFoto): ?>
                        <img src="<?= esc($foto) ?>" alt="<?= esc($username) ?>" referrerpolicy="no-referrer">
                    <?php elseif ($hasLocalFoto): ?>
                        <img src="<?= base_url('uploads/foto/' . $foto) ?>" alt="<?= esc($username) ?>">
                    <?php else: ?>
                        <?= $initial ?>
                    <?php endif; ?>
                </div>
            </a>
        </div>
    </header>

    <!-- ================================================
         MAIN CONTENT AREA
         ================================================ -->
    <main class="main-area">
        <!-- Skeleton Loader -->
        <div class="content-skeleton" id="contentSkeleton">
            <div class="skeleton-header">
                <div class="skeleton-line skeleton-title"></div>
                <div class="skeleton-btn"></div>
            </div>
            <div class="skeleton-grid">
                <div class="skeleton-card">
                    <div class="skeleton-line" style="width: 60%; margin-bottom: 12px;"></div>
                    <div class="skeleton-line" style="width: 90%; margin-bottom: 8px;"></div>
                    <div class="skeleton-line" style="width: 75%;"></div>
                </div>
                <div class="skeleton-card">
                    <div class="skeleton-line" style="width: 60%; margin-bottom: 12px;"></div>
                    <div class="skeleton-line" style="width: 90%; margin-bottom: 8px;"></div>
                    <div class="skeleton-line" style="width: 75%;"></div>
                </div>
                <div class="skeleton-card">
                    <div class="skeleton-line" style="width: 60%; margin-bottom: 12px;"></div>
                    <div class="skeleton-line" style="width: 90%; margin-bottom: 8px;"></div>
                    <div class="skeleton-line" style="width: 75%;"></div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div id="mainContent"></div>
    </main>

</div>

<!-- Page Loader (separate from shell for positioning) -->
<div class="page-loader" id="pageLoader">
    <div class="loader-spinner"></div>
    <div class="loader-text">Memuat...</div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
(function () {
    'use strict';

    var siteBaseUrl = '<?= rtrim(base_url(), '/') ?>/';
    if (window.location.protocol === 'https:' && siteBaseUrl.indexOf('http:') === 0) {
        siteBaseUrl = siteBaseUrl.replace(/^http:/, 'https:');
    }
    window.siteBaseUrl = siteBaseUrl;

    // Page <-> URL mapping
    var pageUrlMap = {
        'dashboard': 'dashboard',
        'meeting': 'meetings',
        'participant': 'participants',
        'discussion': 'discussions',
        'export': 'export',
        'profile': 'settings'
    };
    var urlPageMap = {};
    for (var k in pageUrlMap) { urlPageMap[pageUrlMap[k]] = k; }

    // CSRF
    var csrfName = '<?= csrf_token() ?>';
    var csrfHash = '<?= csrf_hash() ?>';
    window.getCsrfHeaders = function(extraHeaders) {
        var headers = { 'X-CSRF-TOKEN': csrfHash };
        if (extraHeaders) {
            for (var key in extraHeaders) { headers[key] = extraHeaders[key]; }
        }
        return headers;
    };
    window.appendCsrf = function(data) {
        if (data instanceof FormData) {
            data.append(csrfName, csrfHash);
        } else if (typeof data === 'string') {
            data += '&' + csrfName + '=' + encodeURIComponent(csrfHash);
        }
        return data;
    };
    $.ajaxSetup({
        beforeSend: function(xhr, settings) {
            if (settings.type && settings.type.toUpperCase() !== 'GET') {
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfHash);
                if (typeof settings.data === 'string') {
                    settings.data += '&' + csrfName + '=' + encodeURIComponent(csrfHash);
                } else if (settings.data instanceof FormData) {
                    settings.data.append(csrfName, csrfHash);
                } else if (typeof settings.data === 'object' && settings.data !== null && !(settings.data instanceof FormData)) {
                    settings.data[csrfName] = csrfHash;
                }
            }
        }
    });

    var $appShell      = $('#appShell');
    var $sidebar       = $('#sidebar');
    var $overlay       = $('#sidebarOverlay');
    var $mainContent   = $('#mainContent');
    var $mobileToggle  = $('#mobileToggle');
    var $desktopToggle = $('#desktopToggle');
    var $sidebarClose  = $('#sidebarClose');
    var $skeleton      = $('#contentSkeleton');
    var $pageLoader    = $('#pageLoader');

    var isLoading = false;
    var currentPage = null;

    function updateActiveLink(page) {
        $('.sidebar .nav-link').removeClass('active');
        $('.sidebar .nav-link[data-page="' + page + '"]').addClass('active');
    }

    function getPageFromUrl() {
        var basePath = '/';
        try { basePath = new URL(siteBaseUrl).pathname; } catch(e) {}
        var currentPath = window.location.pathname;
        var relative = currentPath.replace(basePath, '').replace(/^\/|\/$/g, '');
        return urlPageMap[relative] || 'dashboard';
    }

    // Core loader (no URL change)
    function loadPageContent(page) {
        if (isLoading) return;
        isLoading = true;
        currentPage = page;

        updateActiveLink(page);

        // Close mobile sidebar
        if (window.innerWidth < 768) {
            $sidebar.removeClass('active');
            $overlay.removeClass('active');
        }

        $mainContent.addClass('is-loading').html('');
        $skeleton.addClass('active');

        var loaderTimeout = setTimeout(function () {
            $pageLoader.addClass('active');
        }, 400);

        $.ajax({
            url: siteBaseUrl + 'partials/' + page + '-content',
            type: 'GET',
            dataType: 'html',
            cache: false,
            beforeSend: function () {
                $('body > .modal[data-spa-modal]').each(function () {
                    var $m = $(this);
                    if ($m.hasClass('show')) { $m.modal('hide'); }
                    $m.remove();
                });
                if (window._participantCleanup) {
                    window._participantCleanup();
                    window._participantCleanup = null;
                }
            },
            success: function (response) {
                clearTimeout(loaderTimeout);
                $mainContent.html(response);
                $mainContent.find('.modal').each(function () {
                    $(this).attr('data-spa-modal', '1').appendTo('body');
                });
                $skeleton.removeClass('active');
                $pageLoader.removeClass('active');
                setTimeout(function () {
                    $mainContent.removeClass('is-loading');
                    isLoading = false;
                }, 50);
            },
            error: function (xhr) {
                clearTimeout(loaderTimeout);
                $skeleton.removeClass('active');
                $pageLoader.removeClass('active');

                if (xhr.status === 401) {
                    try {
                        var data = JSON.parse(xhr.responseText);
                        if (data.redirect) {
                            window.location.href = siteBaseUrl + data.redirect.replace(/^\//, '');
                            return;
                        }
                    } catch (e) {}
                    window.location.href = siteBaseUrl + 'auth/login';
                    return;
                }

                $mainContent.html(
                    '<div style="text-align:center; padding:60px 20px; background:#fff; border:1px solid #E2E8F0; border-radius:12px;">' +
                    '<div style="width:72px; height:72px; margin:0 auto 16px; background:#FEF2F2; color:#DC2626; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:1.5rem;">' +
                    '<i class="fas fa-exclamation-triangle"></i></div>' +
                    '<h5 style="font-family:\'Plus Jakarta Sans\',sans-serif; color:#0F172A; margin-bottom:8px;">Gagal memuat konten</h5>' +
                    '<p style="color:#64748B; font-size:0.9rem; margin-bottom:20px;">Terjadi kesalahan saat memuat halaman.</p>' +
                    '<button onclick="loadContent(\'' + page + '\')" style="padding:10px 24px; background:#0F766E; color:#fff; border:none; border-radius:8px; font-weight:600; cursor:pointer; font-size:0.85rem;">' +
                    '<i class="fas fa-arrow-rotate-right me-2"></i> Coba Lagi</button></div>'
                );
                $mainContent.removeClass('is-loading');
                isLoading = false;
            }
        });
    }

    // Navigate to page (public, with pushState)
    window.loadContent = function (page) {
        var url = siteBaseUrl + (pageUrlMap[page] || 'dashboard');
        history.pushState({page: page}, '', url);
        loadPageContent(page);
    };

    // Browser back/forward
    window.addEventListener('popstate', function (e) {
        var page;
        if (e.state && e.state.page) {
            page = e.state.page;
        } else {
            page = getPageFromUrl();
        }
        loadPageContent(page);
    });

    // Global AJAX error handler
    $(document).ajaxError(function (event, xhr, settings) {
        if (settings && settings.url && settings.url.indexOf('partials/') !== -1) return;
        if (xhr.status === 401) {
            try {
                var data = JSON.parse(xhr.responseText);
                if (data.redirect) {
                    window.location.href = siteBaseUrl + data.redirect.replace(/^\//, '');
                    return;
                }
            } catch (e) {}
            window.location.href = siteBaseUrl + 'auth/login';
        }
    });

    // Refresh avatar in sidebar and topbar after profile update
    window.refreshLayoutAvatar = function (userData) {
        if (!userData) return;
        var foto = userData.foto || '';
        var username = userData.username || '';
        var initial = username.charAt(0).toUpperCase();

        function setAvatar(container) {
            if (!container) return;
            if (foto && foto.indexOf('data:image/') === 0) {
                container.innerHTML = '<img src="' + foto.replace(/"/g, '&quot;') + '" alt="' + initial + '">';
            } else if (foto && (foto.indexOf('http://') === 0 || foto.indexOf('https://') === 0)) {
                container.innerHTML = '<img src="' + foto.replace(/"/g, '&quot;') + '" alt="' + initial + '" referrerpolicy="no-referrer">';
            } else {
                container.textContent = initial;
            }
        }

        setAvatar(document.querySelector('.sidebar-footer .user-avatar'));
        setAvatar(document.querySelector('.topbar-avatar'));

        var sidebarName = document.querySelector('.user-info-name');
        if (sidebarName && username) sidebarName.textContent = username;
    };

    function closeMobileSidebar() {
        $sidebar.removeClass('active');
        $overlay.removeClass('active');
    }

    $(function () {
        // Initial load from server-provided page
        var initialPage = '<?= $initialPage ?? "dashboard" ?>';
        history.replaceState({page: initialPage}, '', window.location.href);
        loadPageContent(initialPage);

        $mobileToggle.on('click', function () {
            $sidebar.addClass('active');
            $overlay.addClass('active');
        });

        $desktopToggle.on('click', function () {
            $appShell.toggleClass('sidebar-collapsed');
            $('body').toggleClass('sidebar-is-collapsed');
        });

        $sidebarClose.on('click', closeMobileSidebar);
        $overlay.on('click', closeMobileSidebar);

        $(document).on('keydown', function (e) {
            if (e.key === 'Escape' && $sidebar.hasClass('active')) {
                closeMobileSidebar();
            }
        });

        var resizeTimer;
        $(window).on('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                if (window.innerWidth >= 768) {
                    $sidebar.removeClass('active');
                    $overlay.removeClass('active');
                }
            }, 100);
        });
    });
})();
</script>

</body>
</html>
