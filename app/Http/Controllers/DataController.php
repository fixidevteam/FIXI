<?php

namespace App\Http\Controllers;

use App\Models\nom_operation;
use App\Models\nom_sous_operation;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function getOperations($categorieId)
    {
        return nom_operation::where('nom_categorie_id', $categorieId)->get();
    }

    public function getSousOperations($operationId)
    {
        return nom_sous_operation::where('nom_operation_id', $operationId)->get();
    }
}