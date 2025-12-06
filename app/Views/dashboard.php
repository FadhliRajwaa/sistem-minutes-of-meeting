<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #e3f2fd; }
        .sidebar { height: 100vh; background-color: #007bff; color: white; padding-top: 20px; }
        .sidebar a { color: white; display: block; padding: 10px 20px; text-decoration: none; }
        .sidebar a:hover, .sidebar a.active { background-color: #0056b3; border-left: 5px solid white; }
        .content-area { padding: 30px; background: #e3f2fd; min-height: 100vh; }
    </style>
</head>

<body class="<?= session('mode') === 'dark' ? 'bg-dark text-white' : '' ?>">
<div class="d-flex">
    
 // SIDEBAR //
    <div class="sidebar">
        <div class="text-center mb-4">
            <img src="<?= base_url('images/mom.png') ?>" alt="Logo" style="width: 80px; height: auto;">
            <h5 class="mt-2">Minutes Meeting</h5>
        </div>
        <a href="#" class="menu-link active" data-target="dashboard-content"><i class="fa fa-home me-2"></i> Dashboard</a>
        <a href="#" class="menu-link" data-target="meeting-content"><i class="fa fa-calendar me-2"></i> Manage Meeting</a>
        <a href="#" class="menu-link" data-target="participant-content"><i class="fa fa-user-plus me-2"></i> Participant Input</a>
        <a href="#" class="menu-link" data-target="discussion-content"><i class="fa fa-edit me-2"></i> Add Discussion</a>
        <a href="#" class="menu-link" data-target="export-content"><i class="fa fa-file-pdf me-2"></i> Export to PDF</a>
    </div>

    <div class="flex-grow-1 content-area">
        <div id="main-content">
            <?= view('partials/dashboard-content') ?>
        </div>
    </div>
</div>

<script>
function loadContent(target) {
    if (!target) return;

    document.querySelectorAll('.menu-link').forEach(el => {
        el.classList.remove('active');
        if (el.getAttribute('data-target') === target) {
            el.classList.add('active');
        }
    });

    if (location.hash !== '#' + target) {
        history.pushState(null, '', '/dashboard#' + target);
    }

    const mainContent = document.getElementById('main-content');
    mainContent.innerHTML = '<p class="text-center mt-5">Loading...</p>';
    fetch('/dashboard/load/' + target)
        .then(res => res.ok ? res.text() : Promise.reject('Halaman tidak ditemukan.'))
        .then(html => mainContent.innerHTML = html)
        .catch(err => {
            console.error(err);
            mainContent.innerHTML = '<p class="text-danger text-center">Gagal memuat konten.</p>';
        });
}

window.addEventListener('hashchange', function () {
    const hash = location.hash.replace('#', '');
    loadContent(hash);
});


document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.menu-link').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const target = this.getAttribute('data-target');
            loadContent(target);
        });
    });

    const initialHash = location.hash.replace('#', '');
    if (initialHash) {
        loadContent(initialHash);
    }
});
</script>
</body>
</html>
