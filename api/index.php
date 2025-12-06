<?php

// Vercel Entry Point
// Forward all requests to public/index.php

// Set writable path to /tmp for Vercel environment
define('WRITEPATH', '/tmp/writable/');

// Ensure directories exist
if (!is_dir(WRITEPATH)) {
    mkdir(WRITEPATH, 0777, true);
    mkdir(WRITEPATH . 'cache', 0777, true);
    mkdir(WRITEPATH . 'logs', 0777, true);
    mkdir(WRITEPATH . 'session', 0777, true);
    mkdir(WRITEPATH . 'uploads', 0777, true);
}

require __DIR__ . '/../public/index.php';
