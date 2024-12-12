<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quartier;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminGestionQuartierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $villes = Ville::all();
        return view('admin.gestionQuartier.create', compact('villes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $quartier = $request->validate([
            'quartier' => [
                'required',
                'string',
                Rule::unique('quartiers', 'quartier')
                    ->where('ville_id', $request->ville_id) // Ensure uniqueness within the same `ville_id`
                    ->whereNull('deleted_at'), // Exclude soft-deleted records
            ],
            'ville_id' => ['required', 'exists:villes,id'], // Ensure `ville_id` exists in the `villes` table
        ]);

        if ($quartier) {
            Quartier::create($quartier);
            session()->flash('success', 'Quartier ajouté');
            session()->flash('subtitle', 'Quartier a été ajouté avec succès.');
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
        $quartier = Quartier::find($id);
        $villes = Ville::all();
        if ($quartier) {
            return view('admin.gestionQuartier.edit', compact('quartier', 'villes'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $quartier = Quartier::find($id);
        $newquartier = $request->validate([
            'quartier' => ['required'],
            'ville_id' => ['required']
        ]);

        if ($quartier) {
            $quartier->update($newquartier);
            session()->flash('success', 'Quartier mise à jour');
            session()->flash('subtitle', 'Quartier a été mis à jour avec succès.');
        }
        return redirect()->route('admin.gestionVille.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quartier = Quartier::find($id);
        if ($quartier) {
            $quartier->delete();
        }
        session()->flash('success', 'Quartier supprimée');
        session()->flash('subtitle', 'Quartier a été supprimée avec succès.');
        return redirect()->route('admin.gestionVille.index');
    }
}