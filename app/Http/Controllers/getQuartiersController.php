<?php

namespace App\Http\Controllers;

use App\Models\Quartier;
use Illuminate\Http\Request;

class getQuartiersController extends Controller
{
    public function getQuartiers(Request $request)
    {
        $quartiers = Quartier::where('ville_id', $request->ville_id)->get();
        return response()->json($quartiers);
    }
}