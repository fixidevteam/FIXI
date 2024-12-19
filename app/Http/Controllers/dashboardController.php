<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(){
        $promotions = Promotion::all();
        // dd($promotions); 
        return view('dashboard',compact('promotions'));
    }
}
