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
        $threeMonthsAgo = Carbon::now()->subMonths(3)->startOfMonth();
        $currentDate = Carbon::now()->endOfMonth();

        $garageId = Auth::user()->garage?->id;

        if (!$garageId) {
            return response()->json([
                'operations' => [],
                'clients' => []
            ], 200); // Return an empty dataset if no garage is associated
        }

        // Fetch operations by month for the logged-in mechanic's garage
        $operations = DB::table('operations')
            ->whereBetween('date_operation', [$threeMonthsAgo, $currentDate])
            ->where('garage_id', $garageId)
            ->selectRaw('YEAR(date_operation) as year, MONTH(date_operation) as month, COUNT(*) as total_operations')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Fetch unique clients by month for the logged-in mechanic's garage
        $clients = DB::table('operations')
            ->join('voitures', 'operations.voiture_id', '=', 'voitures.id')
            ->join('users', 'voitures.user_id', '=', 'users.id')
            ->whereBetween('operations.date_operation', [$threeMonthsAgo, $currentDate])
            ->where('operations.garage_id', $garageId)
            ->selectRaw('YEAR(operations.date_operation) as year, MONTH(operations.date_operation) as month, COUNT(DISTINCT users.id) as total_clients')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        return response()->json([
            'operations' => $operations,
            'clients' => $clients,
        ]);
    }
}