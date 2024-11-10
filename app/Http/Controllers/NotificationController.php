<?php

namespace App\Http\Controllers;

use App\Models\UserPapier;
use App\Models\Voiture;
use App\Models\VoiturePapier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $today = Carbon::now();
        $userId = Auth::id();

        // Fetch user's cars to get associated papierVoiture records
        $userCars = Voiture::where('user_id', $userId)->pluck('id');

        // Fetch expiring personnel documents for the authenticated user
        $paipersPersonnels = UserPapier::where('user_id', $userId)
            ->where(function ($query) use ($today) {
                $query->where('date_fin', '<=', $today->copy()->addDays(7))
                      ->orWhere('date_fin', '<', $today);
            })
            ->get();

        // Fetch expiring vehicle documents related to the user's cars
        $papiersVoitures = VoiturePapier::whereIn('voiture_id', $userCars)
            ->where(function ($query) use ($today) {
                $query->where('date_fin', '<=', $today->copy()->addDays(7))
                      ->orWhere('date_fin', '<', $today);
            })
            ->get();

        return view('notifications.index', compact('paipersPersonnels', 'papiersVoitures'));
    }
}