<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\garage;
use App\Models\Quartier;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $villes = Ville::all();
        $selectedVille = old('ville');
        $quartiers = $selectedVille ? Quartier::where('ville_id', $selectedVille)->get() : collect();
        return view('admin.gestionGarages.create', compact('villes', 'quartiers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'localisation' => ['nullable', 'string'],
            'quartier' => ['nullable', 'string'],
            'ville' => ['required', 'string'],
            'virtualGarage' => ['nullable', 'string'],
            'services' => ['nullable', 'array'], // Expecting an array for services
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        // Fetch the ville name based on the ID
        $ville = Ville::findOrFail($request->ville); // Ensure the ID is valid

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('garage', 'public');
            $data['photo'] = $imagePath;
        }

        // Assign the ville name to the data array
        $data['ville'] = $ville->ville; // Replace 'name' with the actual column for the ville name
        // Generate a unique reference ID
        $lastGarage = Garage::latest()->first(); // Get the last created garage
        $lastId = $lastGarage ? $lastGarage->id : 0; // Get the last ID or start from 0
        $data['ref'] = 'GAR-' . str_pad($lastId + 1, 5, '0', STR_PAD_LEFT); // Format as GAR-00001, GAR-00002, etc.

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
        $villes = Ville::all();
        $selectedVille = old('ville');
        $quartiers = $selectedVille ? Quartier::where('ville_id', $selectedVille)->get() : collect();
        $garage = garage::find($id);

        if ($garage) {
            return view('admin.gestionGarages.edit', compact('garage', 'villes', 'quartiers'));
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
            'ref' => [
                'required',
                // Ensure the ref is unique, excluding the current garage being updated
                Rule::unique('garages')->ignore($garage->id)
            ],
            'localisation' => ['nullable', 'string'],
            'quartier' => ['nullable', 'string'],
            'ville' => ['required', 'string'],
            'virtualGarage' => ['nullable', 'string'],
            'services' => ['nullable', 'array'], // Expecting an array for services
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);
        // Fetch the ville name based on the ID
        $ville = Ville::findOrFail($request->ville); // Ensure the ville ID is valid

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('garage', 'public');
            $data['photo'] = $imagePath;
        }
        // Assign the ville name to the data array
        $data['ville'] = $ville->ville; // Replace 'name' with the actual column for the ville name

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

            // Check if the garage has associated operations
            if ($garage->operations()->exists()) {
                session()->flash('error', 'Impossible de supprimer le garage');
                session()->flash('subtitle', 'Ce garage est lié à des opérations et ne peut pas être supprimé.');
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