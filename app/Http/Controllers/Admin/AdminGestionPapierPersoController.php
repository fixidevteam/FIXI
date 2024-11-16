<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\type_papierp;
use Illuminate\Http\Request;

class AdminGestionPapierPersoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type_papierps = type_papierp::all();
        return view('admin.gestionPapierPerso.index', compact('type_papierps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gestionPapierPerso.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type = $request->validate(['type' => ['required']]);
        type_papierp::create($type);
        session()->flash('success', 'Document ajouté');
        session()->flash('subtitle', 'document a été ajouté avec succès à la liste.');
        return redirect()->route('admin.gestionPapierPerso.index');
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
        $type = type_papierp::find($id);
        if ($type) {
            return view('admin.gestionPapierPerso.edit', compact('type'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $papier = $request->validate(['type' => ['required']]);
        $type = type_papierp::find($id);
        if ($type) {
            $type->update($papier);
        }
        session()->flash('success', 'Document mis à jour');
        session()->flash('subtitle', 'document a été mis à jour avec succès.');
        return redirect()->route('admin.gestionPapierPerso.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = type_papierp::find($id);
        if ($type) {
            $type->delete();
        }
        session()->flash('success', 'Document supprimée');
        session()->flash('subtitle', 'document a été supprimée avec succès.');
        return redirect()->route('admin.gestionPapierPerso.index');
    }
}