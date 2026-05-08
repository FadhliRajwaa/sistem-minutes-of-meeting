<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Minutes of Meeting' ?></title>

    <!-- Preconnect & Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* =============================================
           CSS CUSTOM PROPERTIES — Design System
           ============================================= */
        :root {
            /* Colors */
            --color-primary: #0F766E;
            --color-accent: #0D9488;
            --color-surface: #F8FAFC;
            --color-border: #E2E8F0;
            --color-text: #0F172A;
            --color-muted: #64748B;
            --color-bg: #F1F5F9;
            --color-white: #FFFFFF;
            --color-danger: #EF4444;
            --color-danger-hover: #DC2626;
            --color-active-bg: rgba(15, 118, 110, 0.06);

            /* Layout */
            --sidebar-width: 260px;
            --sidebar-collapsed: 72px;
            --topbar-height: 60px;

            /* Typography */
            --font-body: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            --font-heading: 'Plus Jakarta Sans', 'Inter', sans-serif;

            /* Radius */
            --radius: 10px;
            --radius-sm: 6px;
            --radius-md: 8px;
            --radius-full: 9999px;

            /* Shadows */
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.08);

            /* Motion */
            --ease: cubic-bezier(0.16, 1, 0.3, 1);
            --duration: 0.25s;
        }

        /* =============================================
           RESET & BASE
           ============================================= */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: var(--color-bg);
            font-family: var(--font-body);
            color: var(--color-text);
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
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* =============================================
           SIDEBAR — Fixed Left, Light Theme
           ============================================= */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--color-white);
            border-right: 1px solid var(--color-border);
            position: fixed;
            z-index: 1040;
            left: 0;
            top: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            transition: width var(--duration) var(--ease);
            overflow: hidden;
        }

        /* Sidebar scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 3px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: var(--color-border);
            border-radius: var(--radius-full);
        }

        /* ----- Brand Section ----- */
        .sidebar-brand {
            padding: 20px 20px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid var(--color-border);
            flex-shrink: 0;
            min-height: 72px;
        }

        .sidebar-brand-logo {
            width: 36px;
            height: 36px;
            border-radius: var(--radius-md);
            object-fit: contain;
            flex-shrink: 0;
        }

        .sidebar-brand-text {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            white-space: nowrap;
            transition: opacity var(--duration) var(--ease);
        }

        .sidebar-brand-text h4 {
            font-family: var(--font-heading);
            font-size: 0.9375rem;
            font-weight: 700;
            color: var(--color-text);
            margin: 0;
            line-height: 1.3;
            letter-spacing: -0.01em;
        }

        .sidebar-brand-text .brand-label {
            font-size: 0.625rem;
            color: var(--color-muted);
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-top: 2px;
        }

        /* ----- Navigation ----- */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 16px 12px;
        }

        .sidebar-nav-label {
            font-size: 0.6875rem;
            font-weight: 600;
            color: var(--color-muted);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 8px 12px 6px;
            margin-top: 8px;
            white-space: nowrap;
            overflow: hidden;
            transition: opacity var(--duration) var(--ease);
        }

        .sidebar-nav-label:first-child {
            margin-top: 0;
        }

        .nav.flex-column {
            padding: 0;
            list-style: none;
            margin: 0;
        }

        .nav.flex-column .nav-item {
            margin-bottom: 2px;
        }

        .nav.flex-column .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border-radius: var(--radius-md);
            color: var(--color-muted);
            font-weight: 500;
            font-size: 0.875rem;
            text-decoration: none;
            position: relative;
            cursor: pointer;
            transition:
                background-color var(--duration) var(--ease),
                color var(--duration) var(--ease);
            white-space: nowrap;
            overflow: hidden;
            border: none;
        }

        .nav.flex-column .nav-link:hover {
            background-color: var(--color-surface);
            color: var(--color-text);
        }

        .nav.flex-column .nav-link.active {
            background-color: var(--color-active-bg);
            color: var(--color-primary);
            font-weight: 600;
        }

        .nav.flex-column .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 6px;
            bottom: 6px;
            width: 3px;
            background-color: var(--color-primary);
            border-radius: 0 3px 3px 0;
        }

        .nav.flex-column .nav-link i {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9375rem;
            flex-shrink: 0;
            transition: color var(--duration) var(--ease);
        }

        .nav.flex-column .nav-link.active i {
            color: var(--color-primary);
        }

        .nav.flex-column .nav-link span {
            transition: opacity var(--duration) var(--ease);
        }

        /* ----- Sidebar Footer ----- */
        .sidebar-footer {
            margin-top: auto;
            padding: 16px;
            border-top: 1px solid var(--color-border);
            flex-shrink: 0;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            overflow: hidden;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-accent));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8125rem;
            color: var(--color-white);
            flex-shrink: 0;
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .user-info {
            overflow: hidden;
            white-space: nowrap;
            transition: opacity var(--duration) var(--ease);
        }

        .user-info-name {
            font-weight: 600;
            font-size: 0.8125rem;
            color: var(--color-text);
            line-height: 1.3;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-info-role {
            font-size: 0.6875rem;
            color: var(--color-muted);
            font-weight: 500;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 8px 12px;
            border-radius: var(--radius-md);
            border: 1px solid var(--color-border);
            background: var(--color-white);
            color: var(--color-muted);
            font-size: 0.8125rem;
            font-weight: 500;
            font-family: var(--font-body);
            cursor: pointer;
            transition:
                background-color var(--duration) var(--ease),
                color var(--duration) var(--ease),
                border-color var(--duration) var(--ease);
            text-decoration: none;
            white-space: nowrap;
            overflow: hidden;
        }

        .btn-logout:hover {
            background-color: #FEF2F2;
            color: var(--color-danger);
            border-color: #FECACA;
        }

        .btn-logout i {
            font-size: 0.875rem;
            flex-shrink: 0;
        }

        /* =============================================
           SIDEBAR COLLAPSED STATE (Desktop)
           ============================================= */
        .sidebar.collapsed {
            width: var(--sidebar-collapsed);
        }

        .sidebar.collapsed .sidebar-brand {
            padding: 20px 0 16px;
            justify-content: center;
        }

        .sidebar.collapsed .sidebar-brand-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
            position: absolute;
            pointer-events: none;
        }

        .sidebar.collapsed .sidebar-nav {
            padding: 16px 8px;
        }

        .sidebar.collapsed .sidebar-nav-label {
            opacity: 0;
            height: 0;
            padding: 0;
            margin: 0;
            overflow: hidden;
        }

        .sidebar.collapsed .nav.flex-column .nav-link {
            justify-content: center;
            padding: 10px;
            gap: 0;
        }

        .sidebar.collapsed .nav.flex-column .nav-link span {
            opacity: 0;
            width: 0;
            overflow: hidden;
            position: absolute;
            pointer-events: none;
        }

        .sidebar.collapsed .sidebar-footer {
            padding: 12px 8px;
        }

        .sidebar.collapsed .user-info {
            opacity: 0;
            width: 0;
            overflow: hidden;
            position: absolute;
            pointer-events: none;
        }

        .sidebar.collapsed .user-profile {
            justify-content: center;
        }

        .sidebar.collapsed .btn-logout {
            padding: 8px;
            width: 100%;
        }

        .sidebar.collapsed .btn-logout span {
            display: none;
        }

        /* =============================================
           MAIN CONTENT AREA
           ============================================= */
        .content {
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            transition: margin-left var(--duration) var(--ease);
            display: flex;
            flex-direction: column;
            background: var(--color-bg);
        }

        .content.expanded {
            margin-left: var(--sidebar-collapsed);
        }

        /* ----- Top Bar ----- */
        .topbar {
            height: var(--topbar-height);
            background: var(--color-white);
            border-bottom: 1px solid var(--color-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 1020;
            flex-shrink: 0;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-greeting {
            font-size: 0.8125rem;
            color: var(--color-muted);
            font-weight: 400;
        }

        .topbar-greeting strong {
            color: var(--color-text);
            font-weight: 600;
        }

        .topbar-avatar {
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-accent));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.75rem;
            color: var(--color-white);
            flex-shrink: 0;
            overflow: hidden;
        }

        .topbar-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .btn-toggle {
            width: 36px;
            height: 36px;
            border-radius: var(--radius-md);
            border: 1px solid var(--color-border);
            background: var(--color-white);
            color: var(--color-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition:
                background-color var(--duration) var(--ease),
                color var(--duration) var(--ease),
                border-color var(--duration) var(--ease);
            font-size: 0.875rem;
            padding: 0;
        }

        .btn-toggle:hover {
            background-color: var(--color-surface);
            color: var(--color-text);
            border-color: #CBD5E1;
        }

        /* ----- Content Body ----- */
        .content-body {
            flex: 1;
            padding: 24px;
        }

        /* ----- Fade-In Animation ----- */
        .fade-in {
            animation: fadeInUp 0.3s var(--ease) both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* =============================================
           MOBILE OVERLAY
           ============================================= */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.3);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            z-index: 1035;
            opacity: 0;
            transition: opacity var(--duration) var(--ease);
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* =============================================
           MOBILE CLOSE BUTTON (inside sidebar)
           ============================================= */
        .sidebar-close-mobile {
            position: absolute;
            top: 20px;
            right: 12px;
            width: 28px;
            height: 28px;
            border-radius: var(--radius-sm);
            border: none;
            background: transparent;
            color: var(--color-muted);
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.875rem;
            transition: background-color var(--duration) var(--ease);
            padding: 0;
            z-index: 10;
        }

        .sidebar-close-mobile:hover {
            background-color: var(--color-surface);
            color: var(--color-text);
        }

        /* =============================================
           RESPONSIVE — Mobile (max-width: 768px)
           ============================================= */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width) !important;
                box-shadow: var(--shadow-lg);
                transition: transform var(--duration) var(--ease);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            /* Reset collapsed styles on mobile */
            .sidebar.collapsed {
                width: var(--sidebar-width) !important;
                transform: translateX(-100%);
            }

            .sidebar.collapsed.active {
                transform: translateX(0);
            }

            .sidebar.collapsed .sidebar-brand-text,
            .sidebar.collapsed .nav.flex-column .nav-link span,
            .sidebar.collapsed .user-info,
            .sidebar.collapsed .sidebar-nav-label {
                opacity: 1;
                width: auto;
                position: static;
                height: auto;
                padding: revert;
                margin: revert;
                overflow: visible;
                pointer-events: auto;
            }

            .sidebar.collapsed .sidebar-brand {
                padding: 20px 20px 16px;
                justify-content: flex-start;
            }

            .sidebar.collapsed .sidebar-nav {
                padding: 16px 12px;
            }

            .sidebar.collapsed .nav.flex-column .nav-link {
                justify-content: flex-start;
                padding: 10px 16px;
                gap: 12px;
            }

            .sidebar.collapsed .sidebar-footer {
                padding: 16px;
            }

            .sidebar.collapsed .user-profile {
                justify-content: flex-start;
            }

            .sidebar.collapsed .btn-logout {
                width: 100%;
                padding: 8px 12px;
            }

            .sidebar.collapsed .btn-logout span {
                display: inline;
            }

            .sidebar-close-mobile {
                display: flex;
            }

            .content,
            .content.expanded {
                margin-left: 0 !important;
            }

            .topbar {
                padding: 0 16px;
            }

            .content-body {
                padding: 16px;
            }

            .topbar-greeting {
                display: none;
            }
        }

        /* Desktop: hide mobile hamburger */
        @media (min-width: 769px) {
            #mobileToggle {
                display: none !important;
            }
        }

        /* Mobile: hide desktop toggle */
        @media (max-width: 768px) {
            #desktopToggle {
                display: none !important;
            }
        }

        /* =============================================
           LOADING SKELETON (optional enhancement)
           ============================================= */
        .content-loading {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 200px;
            color: var(--color-muted);
            font-size: 0.875rem;
        }

        .content-loading .spinner-border {
            width: 1.25rem;
            height: 1.25rem;
            border-width: 2px;
            color: var(--color-primary);
            margin-right: 10px;
        }
    </style>
</head>

<body>

<!-- ============================================
     MOBILE OVERLAY
     ============================================ -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- ============================================
     SIDEBAR
     ============================================ -->
<nav class="sidebar" id="sidebar">
    <!-- Close button (mobile only) -->
    <button type="button" class="sidebar-close-mobile" id="sidebarClose" aria-label="Close sidebar">
        <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- Brand -->
    <div class="sidebar-brand">
        <img src="<?= site_url('images/mom.png') ?>" alt="MoM Logo" class="sidebar-brand-logo">
        <div class="sidebar-brand-text">
            <h4>Minutes of Meeting</h4>
            <span class="brand-label">DASHBOARD</span>
        </div>
    </div>

    <!-- Navigation -->
    <div class="sidebar-nav">
        <div class="sidebar-nav-label">Menu Utama</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link active" onclick="loadContent('dashboard'); setActive(this)">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="loadContent('meeting'); setActive(this)">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Manage Meeting</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="loadContent('participant'); setActive(this)">
                    <i class="fas fa-users"></i>
                    <span>Participant Input</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="loadContent('discussion'); setActive(this)">
                    <i class="fas fa-comments"></i>
                    <span>Add Discussion</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-nav-label">Export</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="loadContent('export'); setActive(this)">
                    <i class="fas fa-file-pdf"></i>
                    <span>Export to PDF</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Footer: User Profile & Logout -->
    <div class="sidebar-footer">
        <div class="user-profile">
            <div class="user-avatar">
                <?php
                    $user = session()->get('user');
                    $foto = $user['foto'] ?? '';
                    $username = $user['username'] ?? 'User';
                    $role = $user['role'] ?? 'peserta';
                    $initial = strtoupper(substr($username, 0, 1));
                ?>
                <?php if (!empty($foto) && $foto !== 'default.png'): ?>
                    <img src="<?= base_url('uploads/foto/' . $foto) ?>" alt="<?= esc($username) ?>">
                <?php else: ?>
                    <?= $initial ?>
                <?php endif; ?>
            </div>
            <div class="user-info">
                <div class="user-info-name"><?= esc($username) ?></div>
                <div class="user-info-role"><?= ucfirst(esc($role)) ?></div>
            </div>
        </div>
        <a href="<?= base_url('/auth/logout') ?>" class="btn-logout" title="Logout">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Logout</span>
        </a>
    </div>
</nav>

<!-- ============================================
     MAIN CONTENT
     ============================================ -->
<div id="content" class="content">
    <!-- Top Bar -->
    <header class="topbar">
        <div class="topbar-left">
            <!-- Mobile hamburger (d-md-none) -->
            <button type="button" id="mobileToggle" class="btn-toggle d-md-none" aria-label="Open sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Desktop sidebar toggle (d-none d-md-flex) -->
            <button type="button" id="desktopToggle" class="btn-toggle d-none d-md-flex" aria-label="Toggle sidebar">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>

            <span class="topbar-greeting">
                Selamat datang, <strong><?= esc($username) ?></strong>
            </span>
        </div>

        <div class="topbar-right">
            <div class="topbar-avatar">
                <?php if (!empty($foto) && $foto !== 'default.png'): ?>
                    <img src="<?= base_url('uploads/foto/' . $foto) ?>" alt="<?= esc($username) ?>">
                <?php else: ?>
                    <?= $initial ?>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Content Body -->
    <div class="content-body">
        <div id="mainContent" class="fade-in">
            <!-- SPA content loaded here via AJAX -->
        </div>
    </div>
</div>

<!-- ============================================
     SCRIPTS
     ============================================ -->
<!-- jQuery 3.7.1 -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- Bootstrap 5.3.0 Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
(function () {
    'use strict';

    // ── Base URL with HTTPS force fix ──
    let siteBaseUrl = '<?= rtrim(base_url(), '/') ?>/';
    if (window.location.protocol === 'https:' && siteBaseUrl.startsWith('http:')) {
        siteBaseUrl = siteBaseUrl.replace(/^http:/, 'https:');
    }

    // ── DOM References ──
    const $sidebar        = $('#sidebar');
    const $content        = $('#content');
    const $overlay        = $('#sidebarOverlay');
    const $mainContent    = $('#mainContent');
    const $mobileToggle   = $('#mobileToggle');
    const $desktopToggle  = $('#desktopToggle');
    const $sidebarClose   = $('#sidebarClose');

    // ── loadContent(page) ──
    // Loads partial view via AJAX with fade transition
    window.loadContent = function (page) {
        // Close mobile sidebar
        if (window.innerWidth <= 768) {
            $sidebar.removeClass('active');
            $overlay.removeClass('active');
        }

        // Fade out current content
        $mainContent.css({
            opacity: 0,
            transform: 'translateY(8px)',
            transition: 'opacity 0.15s ease, transform 0.15s ease'
        });

        // Load new content after brief fade-out
        setTimeout(function () {
            $mainContent.load(siteBaseUrl + 'partials/' + page + '-content', function (response, status) {
                if (status === 'error') {
                    $mainContent.html(
                        '<div class="content-loading">' +
                        '<i class="fas fa-exclamation-triangle me-2" style="color:var(--color-danger)"></i>' +
                        'Gagal memuat konten. Silakan coba lagi.' +
                        '</div>'
                    );
                }

                // Force reflow then fade in
                void $mainContent[0].offsetWidth;
                $mainContent.css({
                    transition: 'opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1), transform 0.3s cubic-bezier(0.16, 1, 0.3, 1)',
                    opacity: 1,
                    transform: 'translateY(0)'
                });
            });
        }, 150);
    };

    // ── setActive(element) ──
    // Removes .active from all nav-links, adds to clicked
    window.setActive = function (element) {
        $('.sidebar .nav-link').removeClass('active');
        $(element).addClass('active');
    };

    // ── DOMContentLoaded ──
    document.addEventListener('DOMContentLoaded', function () {

        // 1. Initial load: dashboard
        loadContent('dashboard');

        // 2. Mobile toggle: open sidebar + overlay
        $mobileToggle.on('click', function () {
            $sidebar.addClass('active');
            $overlay.addClass('active');
        });

        // 3. Desktop toggle: collapse/expand sidebar
        $desktopToggle.on('click', function () {
            $sidebar.toggleClass('collapsed');
            $content.toggleClass('expanded');
        });

        // 4. Close sidebar (mobile close button + overlay click)
        $sidebarClose.on('click', closeMobileSidebar);
        $overlay.on('click', closeMobileSidebar);

        // 5. Close sidebar on Escape key
        $(document).on('keydown', function (e) {
            if (e.key === 'Escape' && $sidebar.hasClass('active')) {
                closeMobileSidebar();
            }
        });

        // 6. Handle window resize: clean up mobile state when going to desktop
        let resizeTimer;
        $(window).on('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                if (window.innerWidth > 768) {
                    $sidebar.removeClass('active');
                    $overlay.removeClass('active');
                }
            }, 100);
        });
    });

    // ── Helper: close mobile sidebar ──
    function closeMobileSidebar() {
        $sidebar.removeClass('active');
        $overlay.removeClass('active');
    }

})();
</script>

</body>
</html>
