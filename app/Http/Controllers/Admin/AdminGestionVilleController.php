<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quartier;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminGestionVilleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $villes = Ville::all();
        $quartiers = Quartier::all();
        return view('admin.gestionVille.index', compact('villes', 'quartiers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gestionVille.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ville = $request->validate([
            'ville' => [
                'required',
                'string',
                'max:50',
                Rule::unique('villes', 'ville')->whereNull('deleted_at'), // Exclude soft-deleted records
            ],
        ]);

        if ($ville) {
            Ville::create($ville);
            session()->flash('success', 'Ville ajouté');
            session()->flash('subtitle', 'Ville a été ajouté avec succès.');
            return redirect()->route('admin.gestionVille.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ville = Ville::find($id);
        if ($ville) {
            return view('admin.gestionVille.edit', compact('ville'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ville = $request->validate([
            'ville' => ['required', 'string', 'max:50'], // Ensure 'ville' is unique in the 'villes' table
        ]);
        $villeTarget = Ville::find($id);

        if ($villeTarget) {
            $villeTarget->update($ville);
            session()->flash('success', 'Ville mise à jour');
            session()->flash('subtitle', 'Ville a été mis à jour avec succès.');
        }
        return redirect()->route('admin.gestionVille.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ville = Ville::find($id);
        if ($ville) {
            $ville->quartiers()->delete();
            $ville->delete();
        }
        session()->flash('success', 'Ville supprimée');
        session()->flash('subtitle', 'Ville a été supprimée avec succès.');
        return redirect()->route('admin.gestionVille.index');
    }
}