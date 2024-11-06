<?php

namespace App\Http\Controllers;

use App\Models\Voiture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoitureController extends Controller
{

    public function index()
    {
        $user_id = Auth::user()->id;
        $voitures = Voiture::where('user_id', $user_id)->get();
        return view('userCars.voiture',compact('voitures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("userCars.AjouterVoiture");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $user_id = Auth::user()->id;
        $data = $request->validate([
            'numero_immatriculation' => [
                'required',
                'regex:/^\d{1,6}-[A-Za-z]{1}-\d+$/',
                'unique:voitures,numero_immatriculation'

            ],
            'marque' => ['required', 'max:30'],
            'modele' => ['required', 'max:30'],
            'photo' => ['image'],
            'date_de_première_mise_en_circulation' => ['required', 'date'],
            'date_achat' => ['required', 'date'],
            'date_de_dédouanement' => ['required', 'date'],
        ]);
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('user/voitures', 'public');
            $data['photo'] = $imagePath;
        }
        $data['user_id'] = $user_id;
        Voiture::create($data);
        return redirect()->route('voiture.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd(Voiture::find(11)->operations);
        $voiture  = Voiture::find($id);
        // Check if the authenticated user is the owner of the car
        if ($voiture->user_id !== auth()->id()) {
            abort(403);
        }
        return view('userCars.details',compact('voiture'));
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