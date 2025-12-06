<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
    return view('dashboard');
    }

    public function load($page)
    {
    $allowed = ['dashboard-content', 'meeting-content', 'participant-content', 'discussion-content', 'export-content', 'settings-content'];
    if (in_array($page, $allowed)) {
        return view('partials/' . $page);
    } else {
        return 'Halaman tidak ditemukan.';
    }
    }

}
