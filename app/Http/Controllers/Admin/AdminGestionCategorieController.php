<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\nom_categorie;
use App\Models\nom_operation;
use App\Models\nom_sous_operation;
use App\Models\Operation;
use Illuminate\Http\Request;

class AdminGestionCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = nom_categorie::all();
        $operationsCreatedByUser = Operation::whereNotNull('autre_operation')->get();
        $operations = nom_operation::all();
        // Merge the two collections
        $allOperations = $operations->merge($operationsCreatedByUser);
        
        // dd($allOperations);
        $sousOperations = nom_sous_operation::all();
        return view('admin.gestionCategorie.index', compact('categories', 'allOperations', 'operations', 'sousOperations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gestionCategorie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nom_categorie = $request->validate(['nom_categorie' => ['required']]);

        if ($nom_categorie) {
            nom_categorie::create($nom_categorie);
            session()->flash('success', 'Categorie ajouté');
            session()->flash('subtitle', 'Categorie a été ajouté avec succès.');
            return redirect()->route('admin.gestionCategorie.index');
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
        $categorie = nom_categorie::find($id);
        if ($categorie) {
            return view('admin.gestionCategorie.edit', compact('categorie'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nom_categorie = $request->validate(['nom_categorie' => ['required']]);
        $categorie = nom_categorie::find($id);

        if ($categorie) {
            $categorie->update($nom_categorie);
            session()->flash('success', 'Categorie mise à jour');
            session()->flash('subtitle', 'Categorie a été mis à jour avec succès.');
        }
        return redirect()->route('admin.gestionCategorie.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $categorie = nom_categorie::find($id);
        // dd($categorie);
        if ($categorie) {
            foreach ($categorie->operations as $operation) {
                $operation->sousOperations()->delete();
            }
            $categorie->operations()->delete();
            $categorie->delete();
        }
        session()->flash('success', 'Categorie supprimée');
        session()->flash('subtitle', 'Categorie a été supprimée avec succès.');
        return redirect()->route('admin.gestionCategorie.index');
    }
}
