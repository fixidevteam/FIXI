<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class OperationsExport implements FromView, WithColumnWidths
{
    protected $user;
    protected $operations;
    protected $nom_categories;
    protected $nom_operations;
    protected $voiture;
    protected $logoPath;

    public function __construct($user, $operations, $nom_categories, $nom_operations, $voiture,$logoPath)
    {
        $this->user = $user;
        $this->operations = $operations;
        $this->nom_categories = $nom_categories;
        $this->nom_operations = $nom_operations;
        $this->voiture = $voiture;
        $this->logoPath = $logoPath;
    }

    public function view(): View
    {
        return view('exports.operations', [
            'user' => $this->user,
            'operations' => $this->operations,
            'nom_categories' => $this->nom_categories,
            'nom_operations' => $this->nom_operations,
            'voiture' => $this->voiture,
            'logoPath' => $this->logoPath,
        ]);
    }
    public function columnWidths(): array
    {
        return [
            'A' => 20, // Column for "Numéro d’Immatriculation"
            'B' => 30, // Column for "Date de l’Opération"
            'C' => 30, // Column for "Catégorie d’Opération"
            'D' => 50, // Column for "Nom de l’Opération"
        ];
    }
}