<?php


namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class mechanicDashboardController extends Controller
{
    public function index()
    {
        $operations = Auth::user()->garage->operations;
        $operationsByMonth = $operations->groupBy(function ($operation) {
            return \Carbon\Carbon::parse($operation->date_operation)->format('F'); // Month name
        })->map(function ($group) {
            return $group->count();
        });
        // Create a list of all months
        $allMonths = collect([
            'Janvier',
            'Février',
            'Mars',
            'Avril',
            'Mai',
            'Juin',
            'Juillet',
            'Août',
            'Septembre',
            'Octobre',
            'Novembre',
            'Décembre'
        ]);
        

        // Merge all months with operations, setting missing months to 0
        $operationsByMonth = $allMonths->mapWithKeys(function ($month) use ($operationsByMonth) {
            return [$month => $operationsByMonth->get($month, 0)];
        });
        // Pass data to the view
        return view('mechanic.dashboard', [
            'labels' => $operationsByMonth->keys()->toArray(), // Month names
            'values' => $operationsByMonth->values()->toArray(), // Operation counts
        ]);
    }
}
