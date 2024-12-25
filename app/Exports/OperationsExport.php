<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OperationsExport implements FromView
{
    protected $operations;
    protected $nom_categories;
    protected $nom_operations;
    protected $voiture;

    public function __construct($operations, $nom_categories, $nom_operations, $voiture)
    {
        $this->operations = $operations;
        $this->nom_categories = $nom_categories;
        $this->nom_operations = $nom_operations;
        $this->voiture = $voiture;
    }

    public function view(): View
    {
        return view('exports.operations', [
            'operations' => $this->operations,
            'nom_categories' => $this->nom_categories,
            'nom_operations' => $this->nom_operations,
            'voiture' => $this->voiture
        ]);
    }
}