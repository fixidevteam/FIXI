<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Models\nom_categorie;
use App\Models\nom_operation;
use App\Models\Operation;
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
        $user = Auth::user();

        // Get the search query
        $search = $request->input('search');

        // Fetch the authenticated mechanic's operations and include necessary relationships
        $operations = Operation::whereHas('garage', function ($query) use ($user) {
            $query->where('id', $user->garage_id);
        })
            ->with('voiture')
            ->when($search, function ($query, $search) {
                // Filter by numero_immatriculation
                $query->whereHas('voiture', function ($query) use ($search) {
                    $query->where('numero_immatriculation', 'like', '%' . $search . '%');
                });
            })
            ->get();

        $ope = nom_operation::all(); // Assuming this fetches all operation names
        $categories = nom_categorie::all(); // Assuming this fetches all category names

        // Return the view with the operations, categories, and search term
        return view('mechanic.operations.index', compact('operations', 'categories', 'ope', 'search'));
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
