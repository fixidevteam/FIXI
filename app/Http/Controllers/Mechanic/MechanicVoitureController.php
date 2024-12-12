<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Models\MarqueVoiture;
use App\Models\nom_categorie;
use App\Models\nom_operation;
use App\Models\Operation;
use App\Models\User;
use App\Models\Voiture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class MechanicVoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     // Get the authenticated user's garage operations
    //     $user = Auth::user();
    //     $search = $request->input('search'); // Retrieve the search query

    //     // Fetch voitures related to the user's garage operations
    //     $voitures = collect(); // Initialize an empty collection for voitures

    //     $operations = $user->garage->operations()->with('voiture')->get();

    //     foreach ($operations as $operation) {
    //         if ($operation->voiture) {
    //             $voitures->push($operation->voiture);
    //         }
    //     }

    //     // Filter voitures if search query is provided
    //     if (!empty($search)) {
    //         $voitures = $voitures->filter(function ($voiture) use ($search) {
    //             return stripos($voiture->numero_immatriculation, $search) !== false;
    //         });
    //     }

    //     // Remove duplicate voitures (if any)
    //     $voitures = $voitures->unique('id')->values();

    //     // Pass the voitures and search query to the view
    //     return view('mechanic.voitures.index', compact('voitures', 'search'));
    // }
    public function index(Request $request)
    {
        // Get the authenticated user (mechanic)
        $user = Auth::user();
        $search = $request->input('search'); // Retrieve the search query

        // Fetch voitures related to the user's garage operations
        $voitures = collect(); // Initialize an empty collection for voitures
        $operations = $user->garage->operations()->with('voiture')->get();

        foreach ($operations as $operation) {
            if ($operation->voiture) {
                $voitures->push($operation->voiture);
            }
        }

        // Fetch voitures of users created by the mechanic
        $createdVoitures = User::where('created_by_mechanic', 1)
            ->where('mechanic_id', $user->id)
            ->with('voitures')
            ->get()
            ->pluck('voitures')
            ->flatten();

        // Merge voitures from the garage and those created by the mechanic
        $voitures = $voitures->merge($createdVoitures);

        // Remove duplicate voitures (if any)
        $voitures = $voitures->unique('id')->values();

        // Filter voitures if search query is provided
        if (!empty($search)) {
            $voitures = $voitures->filter(function ($voiture) use ($search) {
                return isset($voiture->numero_immatriculation) &&
                    stripos($voiture->numero_immatriculation, $search) !== false;
            });
        }

        // Pass the voitures and search query to the view
        return view('mechanic.voitures.index', compact('voitures', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $client = Session::get('client');
        $marques = MarqueVoiture::all();
        // dd($client);
        return view('mechanic.voitures.create', compact('marques', 'client'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        $client = Session::get('client');
        $data['user_id'] = $client->id ;
        $data['numero_immatriculation'] = $numeroImmatriculation;
        // Remove temporary fields to avoid unnecessary database columns
        unset($data['part1'], $data['part2'], $data['part3']);

        Voiture::create($data);

        // Flash message to the session
        $request->session()->forget('temp_photo_path');
        session()->flash('success', 'voitire ajoutée');
        session()->flash('subtitle', 'la voiture  a été ajoutée avec succès à la liste.');

        return redirect()->route('mechanic.clients.show',$client);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $user = Auth::user();
        $voiture = User::where(function ($query) use ($user, $id) {
            // Case 1: Voitures linked to the garage
            $query->whereHas('voitures', function ($voitureQuery) use ($user, $id) {
                $voitureQuery->where('id', $id)
                    ->whereHas('operations', function ($operationQuery) use ($user) {
                        $operationQuery->whereHas('garage', function ($garageQuery) use ($user) {
                            $garageQuery->where('id', $user->garage_id);
                        });
                    });
            })
                // Case 2: Voitures of users created by the mechanic
                ->orWhere(function ($query) use ($user, $id) {
                    $query->where('created_by_mechanic', 1)
                        ->where('mechanic_id', $user->id)
                        ->whereHas('voitures', function ($voitureQuery) use ($id) {
                            $voitureQuery->where('id', $id);
                        });
                });
        })
            ->with('voitures.operations') // Eager load voitures and operations
            ->get()
            ->pluck('voitures')
            ->flatten()
            ->firstWhere('id', $id); // Use firstWhere to find voiture by ID

        if ($voiture) {
            Session::put('voiture_id', $id);
            $operations = Operation::where('voiture_id', $voiture->id)
                ->where('garage_id', $user->garage_id)
                ->get();
            // dd($operations); // Debug: Check if the operations are found
            $nom_categories = nom_categorie::all();
            $nom_operations = nom_operation::all();
            return view('mechanic.voitures.show', compact('voiture', 'operations', 'nom_categories', 'nom_operations'));
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
