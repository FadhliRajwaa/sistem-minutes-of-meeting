<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Minutes of Meeting' ?></title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --sidebar-bg: #1a1c23; 
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
            --primary-color: #4e73df;
            --accent-color: #36b9cc;
            --text-light: #e3e6f0;
        }

        body {
            background-color: #f3f4f6;
            font-family: 'Poppins', sans-serif;
            color: #5a5c69;
            overflow-x: hidden;
        }

        /* Sidebar Modern */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar-bg);
            background: linear-gradient(180deg, #1a1c23 0%, #13151a 100%);
            color: var(--text-light);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            bottom: 0;
            box-shadow: 5px 0 15px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            white-space: nowrap;
            overflow-y: auto; /* Enable vertical scrolling */
            overflow-x: hidden;
        }

        /* Custom Scrollbar for Sidebar */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }
        
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar.collapsed .sidebar-brand h4,
        .sidebar.collapsed .sidebar-brand span,
        .sidebar.collapsed .nav-link span,
        .sidebar.collapsed .user-profile div {
            opacity: 0;
            width: 0;
            display: none;
        }

        .sidebar.collapsed .sidebar-brand {
            padding: 1rem 0.5rem;
        }
        
        .sidebar.collapsed .sidebar-brand img {
            margin: 0 auto;
        }

        .sidebar.collapsed .nav-pills .nav-link {
            padding: 0.9rem 0;
            justify-content: center;
        }

        .sidebar.collapsed .nav-pills .nav-link i {
            margin-right: 0;
            font-size: 1.3rem;
        }

        .sidebar.collapsed .nav-pills .nav-link:hover {
            padding-left: 0;
            background-color: rgba(255,255,255,0.1);
        }

        .sidebar.collapsed .user-profile {
            justify-content: center;
        }
        
        .sidebar.collapsed .sidebar-footer .btn-outline-danger {
            padding: 0.5rem;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
        
        .sidebar.collapsed .sidebar-footer .btn-outline-danger span {
            display: none;
        }
        
        .sidebar.collapsed .sidebar-footer .btn-outline-danger i {
            margin: 0;
        }

        .sidebar-brand {
            padding: 2rem 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .sidebar-brand img {
            width: 50px; 
            height: auto; 
            background: rgba(255,255,255,0.1); 
            border-radius: 12px; 
            padding: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .sidebar-brand h4 {
            font-weight: 700;
            font-size: 1.1rem;
            margin-top: 15px;
            color: #fff;
            letter-spacing: 0.5px;
            transition: opacity 0.2s;
        }

        .nav-pills {
            padding: 0 1rem;
            flex-grow: 1;
        }

        .nav-pills .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-pills .nav-link {
            color: rgba(255,255,255,0.6);
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.9rem 1.2rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .nav-pills .nav-link:hover {
            background-color: rgba(255,255,255,0.05);
            color: #fff;
            padding-left: 1.5rem; /* Slide effect */
        }

        .nav-pills .nav-link.active {
            background: linear-gradient(90deg, rgba(78, 115, 223, 0.1) 0%, rgba(78, 115, 223, 0.05) 100%);
            color: #4e73df;
            font-weight: 600;
        }

        .nav-pills .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 15%;
            bottom: 15%;
            width: 4px;
            background-color: #4e73df;
            border-radius: 0 4px 4px 0;
        }
        
        .nav-pills .nav-link i {
            width: 24px;
            text-align: center;
            margin-right: 12px;
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .nav-pills .nav-link:hover i {
            transform: scale(1.1);
        }

        .nav-pills .nav-link.active i {
            color: #4e73df;
        }

        /* User Profile Section in Sidebar */
        .sidebar-footer {
            padding: 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.05);
            background: rgba(0,0,0,0.1);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background-color: #4e73df;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            flex-shrink: 0;
        }

        /* Main Content */
        .content {
            background-color: #f3f4f6;
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            padding: 2rem;
        }
        
        .content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Fade In Animation */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                margin-left: calc(var(--sidebar-width) * -1);
                width: var(--sidebar-width) !important; /* Force full width on mobile when opening */
            }
            .sidebar.active {
                margin-left: 0;
                box-shadow: 10px 0 30px rgba(0,0,0,0.2);
            }
            
            /* Reset collapsed state styles for mobile if class exists */
            .sidebar.collapsed {
                width: var(--sidebar-width); 
            }
            .sidebar.collapsed .sidebar-brand h4,
            .sidebar.collapsed .sidebar-brand span,
            .sidebar.collapsed .nav-link span,
            .sidebar.collapsed .user-profile div {
                opacity: 1;
                width: auto;
                display: block;
            }
            .sidebar.collapsed .nav-pills .nav-link {
                padding: 0.9rem 1.2rem;
                justify-content: flex-start;
            }
            .sidebar.collapsed .nav-pills .nav-link i {
                margin-right: 12px;
            }

            .content {
                margin-left: 0;
                padding: 1.5rem;
            }
            .content.expanded {
                margin-left: 0;
            }
            
            .sidebar-overlay {
                display: none;
                position: fixed;
                width: 100vw;
                height: 100vh;
                background: rgba(0, 0, 0, 0.4);
                backdrop-filter: blur(3px);
                z-index: 999;
                top: 0;
                left: 0;
                transition: opacity 0.3s ease;
            }
            .sidebar-overlay.active {
                display: block;
            }
            
            /* Hide Toggle Button on Mobile Navbar since we have Hamburger */
            #sidebarToggle {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="d-flex">

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-brand position-relative">
            <button type="button" class="btn btn-link text-white d-md-none position-absolute top-0 end-0 m-2 opacity-50 hover-opacity-100" id="sidebarClose">
                <i class="fa fa-times"></i>
            </button>
            <div class="d-flex flex-column align-items-center brand-container">
                <img src="<?= site_url('images/mom.png') ?>" alt="Logo">
                <h4 class="mb-0">Minutes of Meeting</h4>
                <span style="font-size: 0.75rem; color: rgba(255,255,255,0.4); font-weight: 400; letter-spacing: 1px;">DASHBOARD PANEL</span>
            </div>
        </div>

        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="loadContent('dashboard'); setActive(this)">
                    <i class="fa fa-home"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="loadContent('meeting'); setActive(this)">
                    <i class="fa fa-calendar-alt"></i> <span>Manage Meeting</span>
                </a>
            </li>
            <li class="nav-item">
                 <a href="#" class="nav-link" onclick="loadContent('participant'); setActive(this)">
                    <i class="fas fa-users"></i> <span>Participant Input</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="loadContent('discussion'); setActive(this)">
                    <i class="fa fa-comments"></i> <span>Add Discussion</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="loadContent('export'); setActive(this)">
                    <i class="fa fa-file-pdf"></i> <span>Export to PDF</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-footer mt-auto">
            <div class="user-profile mb-3">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div style="line-height: 1.2;">
                    <div style="font-weight: 600; color: #fff;">Admin User</div>
                    <small style="color: rgba(255,255,255,0.5);">Administrator</small>
                </div>
            </div>
            <a href="<?= base_url('/auth/logout') ?>" class="btn btn-outline-danger w-100 btn-sm rounded-pill" title="Logout">
                <i class="fa fa-power-off me-2"></i> <span>Logout</span>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div id="content" class="content w-100">
        <!-- Desktop Toggle & Mobile Hamburger -->
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent mb-4 p-0 d-flex justify-content-between align-items-center">
             <!-- Mobile Hamburger -->
             <button type="button" id="sidebarCollapse" class="btn btn-white shadow-sm border rounded-circle d-md-none" style="width: 45px; height: 45px; background: white;">
                <i class="fa fa-bars text-primary"></i>
            </button>
            
            <!-- Desktop Toggle -->
            <button type="button" id="sidebarToggle" class="btn btn-white shadow-sm border rounded-circle d-none d-md-block" style="width: 45px; height: 45px; background: white; color: #4e73df;">
                <i class="fa fa-bars"></i>
            </button>

            <div class="d-flex align-items-center gap-3">
                <span class="fw-bold text-secondary d-none d-sm-block">Minutes of Meeting System</span>
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; font-size: 0.9rem;">
                    A
                </div>
            </div>
        </nav>

        <div id="mainContent" class="fade-in">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

</div>

<!-- Use CDN for reliability in cloud deployment -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Force HTTPS if current page is HTTPS to avoid Mixed Content errors
    let siteBaseUrl = '<?= base_url() ?>';
    if (window.location.protocol === 'https:' && siteBaseUrl.startsWith('http:')) {
        siteBaseUrl = siteBaseUrl.replace(/^http:/, 'https:');
    }
    
    function loadContent(page) {
        // Tutup sidebar di mobile setelah klik menu
        if (window.innerWidth <= 768) {
            $('#sidebar').removeClass('active');
            $('.sidebar-overlay').removeClass('active');
        }
        
        // Smooth loading transition
        const mainContent = $('#mainContent');
        mainContent.removeClass('fade-in');
        void mainContent[0].offsetWidth; // trigger reflow
        
        mainContent.load(siteBaseUrl + 'partials/' + page + '-content', function() {
            mainContent.addClass('fade-in');
        });
    }
    
    function setActive(element) {
        $('.nav-link').removeClass('active');
        $(element).addClass('active');
    }

    document.addEventListener("DOMContentLoaded", function () {
        // Initial load
        loadContent('dashboard');
        // Set dashboard as active initially
        $('a[onclick*="dashboard"]').addClass('active');

        // Mobile Toggle Sidebar
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $('.sidebar-overlay').toggleClass('active');
        });

        // Desktop Toggle Sidebar (Minimize)
        $('#sidebarToggle').on('click', function () {
            $('#sidebar').toggleClass('collapsed');
            $('#content').toggleClass('expanded');
        });

        $('#sidebarClose, .sidebar-overlay').on('click', function () {
            $('#sidebar').removeClass('active');
            $('.sidebar-overlay').removeClass('active');
        });
    });
</script>
