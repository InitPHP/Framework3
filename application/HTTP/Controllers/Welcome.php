<?php

namespace App\HTTP\Controllers;

class Welcome extends Controller
{

    public function index()
    {
        return view('welcome');
    }

}
