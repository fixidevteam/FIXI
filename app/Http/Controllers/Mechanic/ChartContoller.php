<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartContoller extends Controller
{
    public function index(Request $request)
    {
        // Set locale to French for Carbon
        Carbon::setLocale('fr');

        // Get the selected year, default to the current year
        $selectedYear = $request->input('year', now()->year);

        // Get operations for the mechanic's garage, filtered by the selected year
        $operations = Auth::user()->garage->operations->filter(function ($operation) use ($selectedYear) {
            return Carbon::parse($operation->date_operation)->year == $selectedYear;
        });

        // Group operations by month and count them, using French month names
        $operationsByMonth = $operations->groupBy(function ($operation) {
            return Carbon::parse($operation->date_operation)->translatedFormat('F'); // Month name in French
        })->map(function ($group) {
            return $group->count();
        });

        // Create a list of all months in French
        $allMonths = collect([
            'janvier',
            'février',
            'mars',
            'avril',
            'mai',
            'juin',
            'juillet',
            'août',
            'septembre',
            'octobre',
            'novembre',
            'décembre'
        ]);

        // Merge all months with operations, setting missing months to 0
        $operationsByMonth = $allMonths->mapWithKeys(function ($month) use ($operationsByMonth) {
            return [$month => $operationsByMonth->get($month, 0)];
        });

        // Get distinct years for filtering
        $years = Auth::user()->garage->operations
            ->map(function ($operation) {
                return Carbon::parse($operation->date_operation)->year;
            })
            ->unique()
            ->sort()
            ->values();
            
        // Pass data to the view
        return view('mechanic.chart.index',[
            'labels' => $operationsByMonth->keys()->toArray(), // French month names
            'values' => $operationsByMonth->values()->toArray(), // Operation counts
            'years' => $years, // Available years
            'selectedYear' => $selectedYear // Current selected year
        ]);
    }
}