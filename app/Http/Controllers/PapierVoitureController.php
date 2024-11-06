<?php

namespace App\Http\Controllers;

use App\Models\VoiturePapier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        return redirect()->route('voiture.show', $voiture_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $papier = VoiturePapier::find($id);
        if(!$papier || $papier->voiture_id != Session::get('voiture_id')) {
            abort(403);
        }
        return view('userPaiperVoiture.details', compact('papier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}