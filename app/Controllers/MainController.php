<?php

namespace App\Controllers;

class MainController extends BaseController
{
    public function index()
    {
        return view('Layouts/main');
    }

    public function dashboard()
    {
        return view('partials/dashboard-content');
    }

    public function load($view)
    {
        // Whitelist view yang boleh dimuat (mencegah path traversal)
        $allowed = [
            'dashboard-content',
            'meeting-content',
            'participant-content',
            'discussion-content',
            'export-content',
            'profile-content',
        ];

        if (!in_array($view, $allowed, true)) {
            return $this->response->setStatusCode(404)->setBody('Halaman tidak ditemukan');
        }

        return view('partials/' . $view);
    }
}
