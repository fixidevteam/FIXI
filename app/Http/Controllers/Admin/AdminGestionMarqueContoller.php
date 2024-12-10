<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarqueVoiture;
use Database\Seeders\MarqueSeeder;
use Illuminate\Http\Request;

class AdminGestionMarqueContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marques = MarqueVoiture::all();
        return view('admin.gestionMarque.index', compact('marques'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gestionMarque.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $marqueVoiture = $request->validate(['marque' => ['required']]);

        if ($marqueVoiture) {
            MarqueVoiture::create($marqueVoiture);
            session()->flash('success', 'Marque ajouté');
            session()->flash('subtitle', 'marque a été ajouté avec succès à la liste.');
            return redirect()->route('admin.gestionMarque.index');
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
        $marqueVoiture = MarqueVoiture::find($id);
        if ($marqueVoiture) {
            return view('admin.gestionMarque.edit', compact('marqueVoiture'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $marque = $request->validate(['marque' => ['required']]);
        $targetMarque = MarqueVoiture::find($id);

        if ($targetMarque) {
            $targetMarque->update($marque);
        }
        session()->flash('success', 'Marque mis à jour');
        session()->flash('subtitle', 'marque a été mis à jour avec succès.');
        return redirect()->route('admin.gestionMarque.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $marque = MarqueVoiture::find($id);
        if ($marque) {
            $marque->delete();
        }
        session()->flash('success', 'Marque supprimée');
        session()->flash('subtitle', 'marque a été supprimée avec succès.');
        return redirect()->route('admin.gestionMarque.index');
    }
}