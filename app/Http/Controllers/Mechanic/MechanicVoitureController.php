<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Models\Voiture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;

class MechanicVoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the authenticated user's garage operations
        $user = Auth::user();
        $search = $request->input('search'); // Retrieve the search query

        // Fetch voitures related to the user's garage operations
        $voitures = collect(); // Initialize an empty collection for voitures

        $operations = $user->garage->operations()->with('voiture')->get();

        foreach ($operations as $operation) {
            if ($operation->voiture) {
                $voitures->push($operation->voiture);
            }
        }

        // Filter voitures if search query is provided
        if (!empty($search)) {
            $voitures = $voitures->filter(function ($voiture) use ($search) {
                return stripos($voiture->numero_immatriculation, $search) !== false;
            });
        }

        // Remove duplicate voitures (if any)
        $voitures = $voitures->unique('id')->values();

        // Pass the voitures and search query to the view
        return view('mechanic.voitures.index', compact('voitures', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('mechanic.voitures.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
