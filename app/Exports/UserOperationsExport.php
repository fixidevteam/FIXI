<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class UserOperationsExport implements FromView, WithColumnWidths
{
    protected $user;
    protected $operations;
    protected $categories;
    protected $operationsAll;
    protected $garages;
    protected $logoPath;

    public function __construct($user, $operations, $categories, $operationsAll, $garages, $logoPath)
    {
        $this->user = $user;
        $this->operations = $operations;
        $this->categories = $categories;
        $this->operationsAll = $operationsAll;
        $this->garages = $garages;
        $this->logoPath = $logoPath;
    }

    public function view(): View
    {
        return view('exports.user_operations', [
            'user' => $this->user,
            'operations' => $this->operations,
            'categories' => $this->categories,
            'operationsAll' => $this->operationsAll,
            'garages' => $this->garages,
            'logoPath' => $this->logoPath,
        ]);
    }
    public function columnWidths(): array
    {
        return [
            'A' => 20, // Column for "Numéro d’Immatriculation"
            'B' => 30, // Column for "Date de l’Opération"
            'C' => 20, // Column for "Catégorie d’Opération"
            'D' => 20, // Column for "Nom de l’Opération"
            'E' => 15, // Column for "Nom de l’Opération"
            'F' => 15, // Column for "Nom de l’Opération"
        ];
    }
}