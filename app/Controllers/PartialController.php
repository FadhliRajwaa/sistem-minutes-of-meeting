<?php

namespace App\Controllers;

class PartialController extends BaseController
{
    public function dashboardContent()
    {
        return view('partials/dashboard-content');
    }

    // nanti tambahin method2 partial lain sesuai menu SPA-mu

    public function meeting()
    {
        return view('partials/meeting-content');
    }

    public function participant()
    {
        return view('partials/participant-content');
    }

    public function discussion()
    {
        return view('partials/discussion-content');
    }

    public function export()
    {
        return view('partials/export-content');
    }
    public function dashboard()
    {
    return view('partials/dashboard-content');
    }
    public function settings()
    {
    return view('partials/settings-content');
    }

}

