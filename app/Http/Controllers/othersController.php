<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class othersController extends Controller
{
    public function unauthorized()
    {
        return view('others.notFound');
    }
}