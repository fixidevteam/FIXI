<?php

namespace App\Http\Controllers;

use App\Models\nom_categorie;
use App\Models\nom_operation;
use App\Models\Voiture;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class generateVehicleHistoryPDF extends Controller
{

    public function generateVehicleHistoryPDF($vehicleId)
    {
        // Fetch vehicle and operations
        $voiture = Auth::user()->voitures->find($vehicleId);
        if ($voiture) {
            $categories = nom_categorie::all();
            $operations = nom_operation::all();
            // Load the Blade view and generate PDF
            $pdf = Pdf::loadView('pdf.vehicle-history', compact('voiture', 'categories', 'operations'));
            // Return the PDF as a download
            return $pdf->download('vehicle-history' . $voiture->numero_immatriculation . '.pdf');
        } else {
            abort('403');
        }
    }
}