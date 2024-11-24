<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\garage;
use Illuminate\Http\Request;

class AdminGestionGarageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $garages = garage::all();
        return view('admin.gestionGarages.index', compact('garages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gestionGarages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'ref' => ['required', 'unique:garages'],
            'localisation' => ['nullable', 'string'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('garage', 'public');
            $data['photo'] = $imagePath;
        }

        garage::create($data);
        // Flash message to the session
        session()->flash('success', 'Garage ajoutée');
        session()->flash('subtitle', 'Garage a été ajoutée avec succès à la liste.');

        return redirect()->route('admin.gestionGarages.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $garage = garage::find($id);
        if ($garage) {
            return view('admin.gestionGarages.show', compact('garage'));
        }
        return back()->with('error', 'Garage introuvable');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $garage = garage::find($id);
        
        if($garage){
                return view('admin.gestionGarages.edit', compact('garage'));
        }
        return back()->with('error', 'Garage introuvable');
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $garage = garage::findOrFail($id);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'ref' => ['required'],
            'localisation' => ['nullable', 'string'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('garage', 'public');
            $data['photo'] = $imagePath;
        }
        $garage->update($data);
        // Flash message to the session
        session()->flash('success', 'Garage modifiée');
        session()->flash('subtitle', 'Garage a été modifiée avec succès à la liste.');
        return redirect()->route('admin.gestionGarages.show', $garage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $garage = Garage::find($id);

        if ($garage) {
            // Check if the garage has associated mechanics
            if ($garage->mechanics()->exists()) {
                session()->flash('error', 'Impossible de supprimer le garage');
                session()->flash('subtitle', 'Ce garage contient encore des mécaniciens.');
                return redirect()->route('admin.gestionGarages.index');
            }

            // Delete the garage if it has no mechanics
            $garage->delete();
            session()->flash('success', 'Garage supprimé');
            session()->flash('subtitle', 'Garage a été supprimé avec succès.');
            return redirect()->route('admin.gestionGarages.index');
        }

        session()->flash('error', 'Garage introuvable');
        session()->flash('subtitle', 'Le garage que vous essayez de supprimer n\'existe pas.');
        return redirect()->route('admin.gestionGarages.index');
    }
}