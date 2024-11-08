<?php

namespace App\Http\Controllers;

use App\Models\nom_categorie;
use App\Models\nom_operation;
use App\Models\nom_sous_operation;
use App\Models\Operation;
use App\Models\SousOperation;
use App\Models\Voiture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use PHPUnit\Framework\Constraint\Operator;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort(403);
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
        return redirect()->route('voiture.show',$voiture);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $idvoiture = Session::get('voiture_id');
        $voiture = Voiture::find($idvoiture);
        $operation = Operation::find($id);
        $operations = nom_operation::all();
        $categories = nom_categorie::all();
        $sousOperation = nom_sous_operation::all();
        if (!$operation || $operation->voiture_id != Session::get('voiture_id')) {
            abort(403);
        }
        return view('userOperations.show',compact('voiture','operation','operations','categories','sousOperation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = nom_categorie::all();

        $operation = Operation::find($id);
        return view('userOperations.edit',compact('operation','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $operation = Operation::find($id);
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
        // add operation 
        $data['voiture_id'] = $voiture;
        $operation->update($data);


        // update sous operation 
        if ($request->filled('sousOperations')) {
            // Delete existing sousOperations related to this operation
            $operation->sousOperations()->delete();
    
            // Re-add each sousOperation from the request
            foreach ($request->input('sousOperations') as $idSous) {
                $name = nom_sous_operation::find($idSous);
                SousOperation::create([
                    'nom' => $name->id,
                    'operation_id' => $operation->id
                ]);
            }
        }
        session()->flash('success', 'Operation modifiée');
        session()->flash('subtitle', 'Votre Operation a été modifiée avec succès à la liste.');
        return redirect()->route('voiture.show',$voiture);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $voiture = Session::get('voiture_id');
        $operation = Operation::find($id);
        $operation->sousOperations()->delete();
        $operation->delete();
        session()->flash('success', 'Operation supprimée');
        session()->flash('subtitle', 'Votre Operation a été supprimée avec succès à la liste.');
        return redirect()->route('voiture.show',$voiture);
    }
}