<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\garage;
use App\Models\Promotion;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGestionPromotionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = Promotion::all();
        return view('admin.gestionPromotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $villes = Ville::all();
        $garages = garage::all();
        return view('admin.gestionPromotions.create', compact('villes', 'garages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'nom_promotion' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'date_debut' => 'required|date|before_or_equal:date_fin',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'lien_promotion' => 'required|url',
            'garage_id' => 'required|exists:garages,id',
            'description' => 'nullable|string|max:500',
            'photo_promotion' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validate image file
        ]);

        // Handle the photo upload if present
        if ($request->hasFile('photo_promotion')) {
            $photoPath = $request->file('photo_promotion')->store('promotions/photos', 'public'); // Save photo in "public/promotions/photos"
            $validated['photo_promotion'] = $photoPath; // Add the photo path to the validated data
        }

        // Create the promotion record
        Promotion::create([
            'nom_promotion' => $validated['nom_promotion'],
            'ville' => $validated['ville'],
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
            'lien_promotion' => $validated['lien_promotion'],
            'garage_id' => $validated['garage_id'],
            'description' => $validated['description'] ?? null,
            'photo_promotion' => $validated['photo_promotion'] ?? null, // Add the photo path or null
        ]);

        // Redirect back with success message
        session()->flash('success', 'Promotion ajoutée');
        session()->flash('subtitle', 'La promotion a été ajoutée avec succès.');
        return redirect()->route('admin.gestionPromotions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $promotion = Promotion::findOrFail($id); // Find the promotion or throw a 404
        return view('admin.gestionPromotions.show', compact('promotion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $promotion = Promotion::findOrFail($id);
        $villes = Ville::all(); // Assuming 'Ville' model is used for city data
        $garages = Garage::all(); // Assuming 'Garage' model is used for garages
        return view('admin.gestionPromotions.edit', compact('promotion', 'villes', 'garages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the promotion
        $promotion = Promotion::findOrFail($id);

        // Validate the input data
        $validated = $request->validate([
            'nom_promotion' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'date_debut' => 'required|date|before_or_equal:date_fin',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'lien_promotion' => 'nullable|url',
            'garage_id' => 'required|exists:garages,id',
            'description' => 'nullable|string|max:500',
            'photo_promotion' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Allow null if no new photo
        ]);

        // Handle the photo upload if a new photo is uploaded
        if ($request->hasFile('photo_promotion')) {
            // Delete the old photo if it exists
            if ($promotion->photo_promotion && Storage::disk('public')->exists($promotion->photo_promotion)) {
                Storage::disk('public')->delete($promotion->photo_promotion);
            }

            // Store the new photo and update the validated data
            $photoPath = $request->file('photo_promotion')->store('promotions/photos', 'public');
            $validated['photo_promotion'] = $photoPath;
        } else {
            // Keep the existing photo if no new photo is uploaded
            $validated['photo_promotion'] = $promotion->photo_promotion;
        }

        // Update the promotion with the validated data
        $promotion->update($validated);

        // Flash success messages to the session
        session()->flash('success', 'Promotion mise à jour');
        session()->flash('subtitle', 'La promotion a été mise à jour avec succès.');

        // Redirect back to the promotions list
        return redirect()->route('admin.gestionPromotions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the promotion
        $promotion = Promotion::findOrFail($id);

        // Delete the photo if it exists
        if ($promotion->photo) {
            Storage::disk('public')->delete($promotion->photo);
        }

        // Delete the promotion
        $promotion->delete();

        // Redirect back with success message
        return redirect()->route('admin.gestionPromotions.index')->with('success', 'Promotion supprimée avec succès.');
    }
}