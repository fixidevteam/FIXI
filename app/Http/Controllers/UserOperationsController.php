<?php

namespace App\Http\Controllers;

use App\Exports\UserOperationsExport;
use App\Http\Controllers\Controller;
use App\Models\Operation;
use App\Models\nom_categorie;
use App\Models\nom_operation;
use App\Models\garage;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UserOperationsController extends Controller
{
    public function exportUserOperations()
    {
        $user = Auth::user();
        $operations = Operation::whereHas('voiture', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        $categories = nom_categorie::all();
        $operationsAll = nom_operation::all();
        $garages = garage::all();
        $logoPath = public_path('/images/fixi.png');

        if ($operations->isEmpty()) {
            return back()->with('error', 'No operations found.');
        }

        $filename = 'User_Operations_' . now()->format('Ymd') . '.xlsx';

        return Excel::download(
            new UserOperationsExport($user, $operations, $categories, $operationsAll, $garages, $logoPath),
            $filename
        );
    }
}