<?php
namespace App\Http\Controllers;

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
        return view("userCars.create");
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
                Rule::unique('voitures', 'numero_immatriculation')->whereNull('deleted_at')

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
        // Flash message to the session
        session()->flash('success', 'Voiture ajoutée');
        session()->flash('subtitle', 'Votre voiture a été ajoutée avec succès à la liste.');
        return redirect()->route('voiture.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd(Voiture::find(11)->operations);
        Session::put('voiture_id', $id);
        $operations = nom_operation::all();
        $categories = nom_categorie::all();
        $voiture  = Voiture::find($id);
        if (!$voiture || $voiture->user_id !== auth()->id()) {
            abort(403);
        }

        return view('userCars.show', compact('voiture','operations','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $voiture = Voiture::find($id);
        if (!$voiture || $voiture->user_id !== auth()->id()) {
            abort(403);
        }
        return view('userCars.edit', compact('voiture'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $voiture = Voiture::find($id);
        $user_id = Auth::user()->id;
        $data = $request->validate([
            'numero_immatriculation' => [
                'required',
                'regex:/^\d{1,6}-[A-Za-z]{1}-\d+$/',
                Rule::unique('voitures', 'numero_immatriculation')->ignore($voiture->id)->withoutTrashed()

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
