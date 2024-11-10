<?php

namespace App\Http\Controllers;

use App\Models\UserPapier;
use App\Models\VoiturePapier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $today = Carbon::now();

        // Fetch personnel documents near expiration or expired
        $paipersPersonnels = UserPapier::where('date_fin', '<=', $today->copy()->addDays(7))
            ->orWhere('date_fin', '<', $today)
            ->get();

        // Fetch vehicle documents near expiration or expired
        $papiersVoitures = VoiturePapier::where('date_fin', '<=', $today->copy()->addDays(7))
            ->orWhere('date_fin', '<', $today)
            ->get();

        return view('notifications.index', compact('paipersPersonnels', 'papiersVoitures'));
    }
}