<?php

namespace App\Http\Controllers;

use App\Models\VoiturePapier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function PHPSTORM_META\type;

class PapierVoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return abort(403);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("userPaiperVoiture.AjouterPaiperVoiture");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $voiture_id = Session::get('voiture_id');
        $data = $request->validate([
            'type' => ['required', 'max:30'],
            'note' => ['max:255'],
            'photo' => ['image'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date'],

        ]);

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('user/papierVoiture', 'public');
            $data['photo'] = $imagePath;
        }
        $data['voiture_id'] = $voiture_id;
        VoiturePapier::create($data);
        session()->flash('success', 'Document ajouté');
        session()->flash('subtitle', 'Votre document a été ajouté avec succès à la liste.');
        return redirect()->route('voiture.show', $voiture_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $papier = VoiturePapier::find($id);
        if (!$papier || $papier->voiture_id != Session::get('voiture_id')) {
            abort(403);
        }
        return view('userPaiperVoiture.details', compact('papier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $papier = VoiturePapier::find($id);
        if (!$papier || $papier->voiture_id != Session::get('voiture_id')) {
            abort(403);
        }
        return view('userPaiperVoiture.edit', compact('papier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $papier = VoiturePapier::find($id);
        $voiture_id = Session::get('voiture_id');
        $data = $request->validate([
            'type' => ['required', 'max:30'],
            'note' => ['max:255'],
            'photo' => ['image'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date'],

        ]);

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('user/papierVoiture', 'public');
            $data['photo'] = $imagePath;
        }
        $data['voiture_id'] = $voiture_id;
        $papier->update($data);
        session()->flash('success', 'Document mise à jour');
        session()->flash('subtitle', 'Votre document a été mise à jour avec succès à la liste.');
        return redirect()->route('voiture.show', $voiture_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $papier = VoiturePapier::find($id);
        $voiture_id = $papier->voiture_id;
        // dd($voiture_id);
        if ($papier) {
            $papier->delete();
        }
        session()->flash('success', 'Document supprimée');
        session()->flash('subtitle', 'Votre document a été supprimée avec succès.');
        return redirect()->route('voiture.show', $voiture_id);
    }
}