<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class getAnalyticsDataController extends Controller
{

    public function getAnalyticsData()
    {
        $threeMonthsAgo = Carbon::now()->subMonths(3);
        // dd(Auth::user()->garage->id);
        $garageId = Auth::user()->garage?->id;

        if (!$garageId) {
            return response()->json([
                'operations' => [],
                'clients' => []
            ], 200); // Return an empty dataset if no garage is associated
        }

        // Fetch operations by month for the logged-in mechanic's garage
        $operations = DB::table('operations')
            ->where('date_operation', '>=', $threeMonthsAgo)
            ->where('garage_id', $garageId)
            ->selectRaw('MONTH(date_operation) as month, COUNT(*) as total_operations')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Fetch unique clients by month for the logged-in mechanic's garage
        $clients = DB::table('operations')
            ->join('voitures', 'operations.voiture_id', '=', 'voitures.id')
            ->join('users', 'voitures.user_id', '=', 'users.id')
            ->where('operations.date_operation', '>=', $threeMonthsAgo)
            ->where('operations.garage_id', $garageId)
            ->selectRaw('MONTH(operations.date_operation) as month, COUNT(DISTINCT users.id) as total_clients')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return response()->json([
            'operations' => $operations,
            'clients' => $clients,
        ]);
    }
}