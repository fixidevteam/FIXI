<?php

namespace App\Http\Controllers;

use App\Models\MarqueVoiture;
use App\Models\nom_categorie;
use App\Models\nom_operation;
use App\Models\Voiture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class VoitureController extends Controller
{

    public function index()
    {
        $user_id = Auth::user()->id;
        $voitures = Voiture::where('user_id', $user_id)->get();
        return view('userCars.index', compact('voitures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marques = MarqueVoiture::all();
        return view("userCars.create", compact('marques'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user_id = Auth::user()->id;

        // Vérifiez si l'utilisateur a déjà atteint la limite
        $existingVoituresCount = Voiture::where('user_id', $user_id)->count();
        if ($existingVoituresCount >= 1) {
            // Redirection avec un message d'assistance
            session()->flash('error', 'Vous avez atteint la limite autorisée.');
            session()->flash('subtitle', 'Pour ajouter davantage, merci de nous contacter.');
            return redirect()->route('voiture.index');
        }
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('user/voitures', 'public');
            $request->session()->put('temp_photo_path', $imagePath); // Save the path in the session    

        }
        $data = $request->validate([
            'part1' => ['required', 'digits_between:1,6'], // 1 to 6 digits
            'part2' => ['required', 'string', 'size:1'], // Single Arabic letter
            'part3' => ['required', 'digits_between:1,2'], // 1 to 2 digits
            'marque' => ['required', 'max:30'],
            'modele' => ['required', 'max:30'],
            'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'], // Allow only JPG, PNG, and PDF, max size 2MB                'date_debut' => ['required', 'date'],
            'date_de_première_mise_en_circulation' => ['nullable', 'date'],
            'date_achat' => ['nullable', 'date'],
            'date_de_dédouanement' => ['nullable', 'date'],
        ]);

        // Use temp_photo_path if no new file is uploaded
        if (!$request->hasFile('photo') && $request->input('temp_photo_path')) {
            $data['photo'] = $request->input('temp_photo_path');
        } elseif ($request->hasFile('photo')) {
            $data['photo'] = $imagePath;
        }
        // Combine the parts into the `numero_immatriculation`
        $numeroImmatriculation = $data['part1'] . '-' . $data['part2'] . '-' . $data['part3'];
        $request->validate([
            'numero_immatriculation' => [
                'regex:/^\d{1,6}-[أ-ي]{1}-\d{1,2}$/', // Ensure it matches the pattern
                Rule::unique('voitures', 'numero_immatriculation')->whereNull('deleted_at'), // Check uniqueness
            ],
        ]);

        $data['user_id'] = $user_id;
        $data['numero_immatriculation'] = $numeroImmatriculation;
        // Remove temporary fields to avoid unnecessary database columns
        unset($data['part1'], $data['part2'], $data['part3']);
        Voiture::create($data);

        // Flash message to the session
        $request->session()->forget('temp_photo_path');
        session()->flash('success', 'Voiture ajoutée');
        session()->flash('subtitle', 'Votre voiture a été ajoutée avec succès à la liste.');
        return redirect()->route('voiture.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Session::put('voiture_id', $id);
        $operations = nom_operation::all();
        $categories = nom_categorie::all();
        $voiture  = Voiture::find($id);
        if (!$voiture || $voiture->user_id !== auth()->id()) {
            abort(403);
        }

        return view('userCars.show', compact('voiture', 'operations', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $voiture = Voiture::find($id);
        $marques = MarqueVoiture::all();
        if (!$voiture || $voiture->user_id !== auth()->id()) {
            abort(403);
        }
        return view('userCars.edit', compact('voiture', 'marques'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $voiture = Voiture::find($id);
        $user_id = Auth::user()->id;
        $data = $request->validate([
            'part1' => ['required', 'digits_between:1,6'], // 1 to 6 digits
            'part2' => ['required', 'string', 'size:1'], // Single Arabic letter
            'part3' => ['required', 'digits_between:1,2'], // 1 to 2 digits
            'marque' => ['required', 'max:30'],
            'modele' => ['required', 'max:30'],
            'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'], // Allow only JPG, PNG, and PDF, max size 2MB                'date_debut' => ['required', 'date'],
            'date_de_première_mise_en_circulation' => ['nullable', 'date'],
            'date_achat' => ['nullable', 'date'],
            'date_de_dédouanement' => ['nullable', 'date'],
        ]);
        // Combine the parts into the `numero_immatriculation`
        $numeroImmatriculation = $data['part1'] . '-' . $data['part2'] . '-' . $data['part3'];
        // Validate the uniqueness of the combined `numero_immatriculation`, ignoring the current voiture record
        $request->validate([
            'numero_immatriculation' => [
                'regex:/^\d{1,6}-[أ-ي]{1}-\d{1,2}$/', // Ensure it matches the pattern
                Rule::unique('voitures', 'numero_immatriculation')->ignore($voiture->id)->whereNull('deleted_at'), // Check uniqueness while ignoring current record
            ],
        ]);
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('user/voitures', 'public');
            $data['photo'] = $imagePath;
        }
        // Add user ID and combined numero_immatriculation
        $data['user_id'] = $user_id;
        $data['numero_immatriculation'] = $numeroImmatriculation;
        // Remove temporary fields to avoid unnecessary database columns
        unset($data['part1'], $data['part2'], $data['part3']);
        $voiture->update($data);
        // Flash message to the session
        session()->flash('success', 'Voiture mise à jour');
        session()->flash('subtitle', 'Votre voiture a été mise à jour avec succès dans la liste.');
        return redirect()->route('voiture.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $voiture = Voiture::find($id);
        if ($voiture) {
            $voiture->papiersVoiture()->delete();
            $voiture->operations()->delete();
            $voiture->delete();
        }
        session()->flash('success', 'Voiture supprimée');
        session()->flash('subtitle', 'Votre voiture a été supprimée avec succès.');
        return redirect()->route('voiture.index');
    }
}