<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminGestionUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.gestionUtilisateurs.index', compact('users'));
    }
    /**
     * Edit the status of account 
     */
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status; // Toggle the status
        $user->save();

        return redirect()->route('admin.gestionUtilisateurs.index')->with('success', 'Statut de l\'utilisateur mis à jour avec succès.');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.gestionUtilisateurs.show', compact('user'));
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