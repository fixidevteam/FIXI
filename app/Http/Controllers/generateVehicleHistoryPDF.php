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
        // Fetch the authenticated user's vehicle
        $voiture = Auth::user()->voitures()->find($vehicleId);

        // Check if the vehicle exists
        if (!$voiture) {
            abort(403);
        }

        try {
            // Fetch categories and operations
            $categories = nom_categorie::all();
            $operations = nom_operation::all();

            // Load the Blade view and generate the PDF
            $pdf = Pdf::loadView('pdf.vehicle-history', compact('voiture', 'categories', 'operations'))->setPaper('a4', 'portrait');

            // Return the PDF as a download
            return $pdf->download('vehicle-history-' . $voiture->numero_immatriculation . '.pdf');
        } catch (\Exception $e) {
            // Handle any errors during PDF generation
            session()->flash('error', 'Erreur de téléchargement.');
            session()->flash('subtitle', 'Veuillez réessayer après quelques minutes.');
            // Redirect back with an error message
            return redirect()->back()->withErrors(['message' => 'Erreur lors de la génération du PDF.']);
        }
    }
}