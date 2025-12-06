<?php

namespace App\Controllers;

class MainController extends BaseController
{
    public function index()
    {
        return view('layouts/main');
    }

    public function welcome()
    {
        return view('wellcome');
    }
        public function load($view)
    {
        return view('partials/' . $view);
    }

}
