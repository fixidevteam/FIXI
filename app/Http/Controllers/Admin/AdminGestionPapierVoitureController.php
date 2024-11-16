<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\type_papierv;
use Illuminate\Http\Request;

class AdminGestionPapierVoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type_papierVoitures = type_papierv::all();
        return view('admin.gestionPapierVoiture.index', compact('type_papierVoitures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gestionPapierVoiture.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type = $request->validate(['type' => ['required']]);

        if ($type) {
            type_papierv::create($type);
            session()->flash('success', 'Document ajouté');
            session()->flash('subtitle', 'document a été ajouté avec succès à la liste.');
            return redirect()->route('admin.gestionPapierVoiture.index');
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
        $type = type_papierv::find($id);
        if ($type) {
            return view('admin.gestionPapierVoiture.edit', compact('type'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $papier = $request->validate(['type' => ['required']]);
        $type = type_papierv::find($id);

        if ($type) {
            $type->update($papier);
        }
        session()->flash('success', 'Document mis à jour');
        session()->flash('subtitle', 'document a été mis à jour avec succès.');
        return redirect()->route('admin.gestionPapierVoiture.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = type_papierv::find($id);
        // dd($type);
        if ($type) {
            $type->delete();
        }
        session()->flash('success', 'Document supprimée');
        session()->flash('subtitle', 'document a été supprimée avec succès.');
        return redirect()->route('admin.gestionPapierVoiture.index');
    }
}