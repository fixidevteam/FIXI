<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\nom_categorie;
use App\Models\nom_operation;
use App\Models\nom_sous_operation;
use App\Models\type_papierv;
use Illuminate\Http\Request;

class AdminGestionSousOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $operation = nom_operation::all();
        return view('admin.gestionSousOperation.create', compact('operation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Sous = $request->validate(
            [
                'nom_operation_id' => ['required'],
                'nom_sous_operation' => ['required'],
            ]
        );

        if ($Sous) {
            nom_sous_operation::create($Sous);
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
        $operations = nom_operation::all();
        $sous = nom_sous_operation::find($id);
        if ($sous) {
            return view('admin.gestionSousOperation.edit', compact('operations', 'sous'));
        };
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $newsous = $request->validate(
            [
                'nom_operation_id' => ['required'],
                'nom_sous_operation' => ['required'],
            ]
        );
        $sous = nom_sous_operation::find($id);
        if ($sous) {
            $sous->update($newsous);
            return redirect()->route('admin.gestionCategorie.index');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Sous = nom_sous_operation::find($id);
        // dd($type);
        if ($Sous) {
            $Sous->delete();
        }
        return redirect()->route('admin.gestionCategorie.index');
    }
}
