<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Exports\OperationsExport;
use App\Models\Operation;
use App\Models\nom_categorie;
use App\Models\nom_operation;
use App\Models\Voiture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportOperations($voitureId)
    {
        $user = Auth::user();

        // Fetch the operations related to the given voiture ID and the authenticated user's garage
        $operations = Operation::where('voiture_id', $voitureId)
            ->where('garage_id', $user->garage_id)
            ->get();

        if ($operations->isEmpty()) {
            return back()->with('error', 'Aucune opération trouvée pour le véhicule sélectionné.');
        }

        // Fetch categories and operations data for the view
        $nom_categories = nom_categorie::all(); // Fetch all categories
        $nom_operations = nom_operation::all(); // Fetch all operations

        // Retrieve the associated vehicle
        $voiture = Voiture::find($voitureId);
        if (!$voiture) {
            return back()->with('error', 'Véhicule introuvable.');
        }

        // Generate the filename dynamically
        $filename = 'Suivi_Operations_' . ($voiture->numero_immatriculation ?? 'Vehicule') . '.xlsx';
        $logoPath = public_path('images/fixi.png');
        // Pass operations, categories, operation names, and voiture to the export
        return Excel::download(
            new OperationsExport($user, $operations, $nom_categories, $nom_operations, $voiture, $logoPath),
            $filename
        );
    }
}
