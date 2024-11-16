<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\garage;
use App\Models\Mechanic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminGestionMechanicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mechanics = Mechanic::all();
        return view('admin.gestionMechanics.index', compact('mechanics'));
    }
    /**
     * Edit the status of account 
     */
    public function toggleStatus($id)
    {
        $mechanic = Mechanic::findOrFail($id);
        $mechanic->status = !$mechanic->status; // Toggle the status
        $mechanic->save();

        return redirect()->route('admin.gestionGaragistes.index')->with('success', 'Statut de l\'utilisateur mis à jour avec succès.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $garages = garage::all();
        return view('admin.gestionMechanics.create', compact('garages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mechanics',
            'password' => 'required|string|min:8|confirmed',
            'garage_id' => 'required|exists:garages,id',
            'telephone' => [
                'required',
                'string',
                'max:20',
                'regex:/^(\+2126\d{8}|\+2127\d{8}|06\d{8}|07\d{8})$/',
            ],
        ]);

        Mechanic::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'garage_id' => $request->garage_id,
            'telephone' => $request->telephone,
            'status' => 1,
        ]);

        return redirect()->route('admin.gestionGaragistes.index')->with('success', 'Compte mécanicien créé avec succès!');
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
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return back();
    }
}