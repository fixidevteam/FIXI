<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Models\garage;
use App\Models\nom_categorie;
use App\Models\nom_operation;
use App\Models\nom_sous_operation;
use App\Models\Operation;
use App\Models\SousOperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MechanicOperatioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Get the search query
        $search = $request->input('search');

        // Fetch the authenticated mechanic's operations and include necessary relationships
        $operations = Operation::whereHas('garage', function ($query) use ($user) {
            $query->where('id', $user->garage_id);
        })
            ->with('voiture')
            ->when($search, function ($query, $search) {
                // Filter by numero_immatriculation
                $query->whereHas('voiture', function ($query) use ($search) {
                    $query->where('numero_immatriculation', 'like', '%' . $search . '%');
                });
            })
            ->get();

        $ope = nom_operation::all();
        $categories = nom_categorie::all();
        // dd($operations);
        return view('mechanic.operations.index', compact('operations', 'categories', 'ope', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $garages = garage::all();
        $categories = nom_categorie::all();
        return view('mechanic.operations.create', compact('garages', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $garage = Auth::user()->garage_id;
        $voiture = Session::get('voiture_id');
        $data = $request->validate([
            'categorie' => [
                'required',
            ],
            'nom' => ['required'],
            'description' => ['max:255'],
            'photo' => ['image'],
            'date_operation' => ['required', 'date'],
        ]);
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('user/operations', 'public');
            $data['photo'] = $imagePath;
        }

        $data['voiture_id'] = $voiture;
        $data['garage_id'] = $garage;
        $operation = Operation::create($data);

        // add sous operation 
        if ($request->filled('sousOperations')) {
            // If sousOperations is not empty, dump and display the data
            foreach ($request->input('sousOperations') as $idSous) {
                $name = nom_sous_operation::find($idSous);
                SousOperation::create(
                    [
                        'nom' => $name->id,
                        'operation_id' => $operation->id
                    ]
                );
            }
        }

        // Flash message to the session
        session()->flash('success', 'Operation ajoutée');
        session()->flash('subtitle', 'Votre Operation a été ajoutée avec succès à la liste.');
        return redirect()->route('mechanic.voitures.show', $voiture);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();

        // Find the operation that belongs to the mechanic's garage
        $operation = Operation::whereHas('garage', function ($query) use ($user) {
            $query->where('id', $user->garage_id);
        })
            ->with(['voiture', 'garage'])
            ->find($id);
        if ($operation) {
            $ope = nom_operation::all();
            $categories = nom_categorie::all();
            $sousOperation = nom_sous_operation::all();
            return view('mechanic.operations.show', compact('operation', 'categories', 'ope', 'sousOperation'));
        }
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