<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testContreller extends Controller
{
    public function index()
    {
        return view('admin.test.index');
    }
}