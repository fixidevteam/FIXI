<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $promotions = Promotion::where('ville', $user->ville) // Filter by promotion's ville
            ->where('date_fin', '>=', now()) // Filter by date_fin
            ->get();


        return view('dashboard', compact('promotions'));
    }
}