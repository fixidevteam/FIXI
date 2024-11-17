<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\nom_categorie;
use App\Models\nom_operation;
use Illuminate\Http\Request;

class AdminGestionOperationController extends Controller
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
        $categories = nom_categorie::all();
        return view('admin.gestionOperation.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $nom_operation = $request->validate([
            'nom_operation' => ['required'],
            'nom_categorie_id' => ['required']
        ]);
        if ($nom_operation) {
            nom_operation::create($nom_operation);
            session()->flash('success', 'Operation ajouté');
            session()->flash('subtitle', 'Operation a été ajouté avec succès.');
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
        $operation = nom_operation::find($id);
        $categories = nom_categorie::all();
        if ($operation) {
            return view('admin.gestionOperation.edit', compact('operation', 'categories'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $operation = nom_operation::find($id);
        $newoperation = $request->validate([
            'nom_operation' => ['required'],
            'nom_categorie_id' => ['required']
        ]);

        if ($operation) {
            $operation->update($newoperation);
            session()->flash('success', 'Operation mise à jour');
            session()->flash('subtitle', 'Operation a été mis à jour avec succès.');
        }
        return redirect()->route('admin.gestionCategorie.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $operation = nom_operation::find($id);
        if ($operation) {
            $operation->sousOperations()->delete();
            $operation->delete();
        }
        session()->flash('success', 'Operation supprimée');
        session()->flash('subtitle', 'Operation a été supprimée avec succès.');
        return redirect()->route('admin.gestionCategorie.index');
    }
}