<?php

ini_set('display_errors', '1');
error_reporting(E_ALL);

// Vercel Entry Point
// Forward all requests to public/index.php

// Set writable path to /tmp for Vercel environment
define('WRITEPATH', '/tmp/writable/');

// Ensure directories exist
if (!is_dir(WRITEPATH)) {
    mkdir(WRITEPATH, 0755, true);
}
foreach (['cache', 'logs', 'session', 'uploads'] as $dir) {
    if (!is_dir(WRITEPATH . $dir)) {
        mkdir(WRITEPATH . $dir, 0755, true);
    }
}

try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    http_response_code(500);
    echo '<h1>Error</h1>';
    echo '<pre>' . $e->getMessage() . "\n" . $e->getFile() . ':' . $e->getLine() . "\n" . $e->getTraceAsString() . '</pre>';
}
