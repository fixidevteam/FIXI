<?php

namespace App\Http\Controllers;

use App\Models\nom_categorie;
use App\Models\nom_operation;
use App\Models\nom_sous_operation;
use App\Models\Operation;
use App\Models\SousOperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd(Session::get('voiture_id'));
        $categories = nom_categorie::all();
        return view('userOperations.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            // add operation 
        $operation_name = nom_operation::find($request->nom)->nom_operation;
        $categorie_name = nom_categorie::find($request->nom)->nom_categorie;
        $voiture = Session::get('voiture_id');
        $data = $request->validate([
            'categorie' => [
                'required',
            ],
            'nom' => ['required'],
            'description' => ['required'],
            'photo' => ['image'],
            'date_operation' => ['required', 'date'],
        ]);
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('user/operations', 'public');
            $data['photo'] = $imagePath;
        }
        $data['nom'] = $operation_name;
        $data['categorie'] = $categorie_name;
        $data['voiture_id'] = $voiture;
        $operation = Operation::create($data);

        // add sous operation 
        if ($request->filled('sousOperations')) {
            // If sousOperations is not empty, dump and display the data
            foreach ($request->input('sousOperations') as $idSous) {
                $name = nom_sous_operation::find($idSous);
                SousOperation::create(
                    [
                        'nom' => $name->nom_sous_operation,
                        'operation_id' => $operation->id
                    ]
                );
            }
        }

        // Flash message to the session
        // session()->flash('success', 'Voiture ajoutée');
        // session()->flash('subtitle', 'Votre voiture a été ajoutée avec succès à la liste.');
        return redirect()->route('voiture.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('userOperations.show');
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
