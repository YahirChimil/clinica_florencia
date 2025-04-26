<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('informacion');
    }

    public function informacion(): string
    {
        return view('informacion');
    }
}
