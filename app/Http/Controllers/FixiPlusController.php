<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FixiPlusController extends Controller
{
    public function index()
    {
        return view('fixiPlus.index');
    }
}