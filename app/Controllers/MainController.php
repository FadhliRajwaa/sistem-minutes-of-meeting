<?php

namespace App\Controllers;

class MainController extends BaseController
{
    public function index()
    {
        $segment = $this->request->getUri()->getSegment(1);

        $pageMap = [
            'dashboard'    => 'dashboard',
            'meetings'     => 'meeting',
            'participants' => 'participant',
            'discussions'  => 'discussion',
            'export'       => 'export',
            'settings'     => 'profile',
        ];

        $initialPage = $pageMap[$segment] ?? 'dashboard';

        return view('Layouts/main', ['initialPage' => $initialPage]);
    }

    public function dashboard()
    {
        return view('partials/dashboard-content');
    }
}
