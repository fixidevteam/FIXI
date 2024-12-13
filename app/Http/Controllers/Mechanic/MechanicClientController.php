<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Models\MarqueVoiture;
use App\Models\MechanicClient;
use App\Models\User;
use App\Models\Ville;
use App\Models\Voiture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class MechanicClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user(); // Authenticated mechanic

        // Get search query
        $search = $request->input('search');

        // Fetch clients from the mechanic's garage
        $garageClientsQuery = User::whereHas('voitures', function ($query) use ($user) {
            $query->whereHas('operations', function ($operationQuery) use ($user) {
                $operationQuery->whereHas('garage', function ($garageQuery) use ($user) {
                    $garageQuery->where('id', $user->garage_id);
                });
            });
        });

        // Apply search filter to garage clients
        if ($search) {
            $garageClientsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Fetch clients explicitly created by the authenticated mechanic
        $createdClientsQuery = User::where('created_by_mechanic', 1)
            ->where('mechanic_id', $user->id);

        // Apply search filter to created clients
        if ($search) {
            $createdClientsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Combine both queries using `union`
        $clients = $garageClientsQuery->union($createdClientsQuery)
            ->with('voitures.operations') // Eager load relationships
            ->get();

        return view('mechanic.clients.index', compact('clients', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marques = MarqueVoiture::all();
        $villes = Ville::all();
        return view('mechanic.clients.create', compact('marques','villes'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'email' => ['nullable', 'email', 'unique:' . User::class],
            'telephone' => [
                'required',
                'string',
                'max:20',
                'regex:/^(\+2126\d{8}|\+2127\d{8}|06\d{8}|07\d{8})$/',
            ],
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
        $created_user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'ville' => $request->ville,
            'telephone' => $request->telephone,
            'status' => 0,
            'created_by_mechanic' => 1,
            'mechanic_id' => Auth::user()->id,
        ]);
        $data['user_id'] = $created_user->id;
        $data['numero_immatriculation'] = $numeroImmatriculation;
        // Remove temporary fields to avoid unnecessary database columns
        unset($data['part1'], $data['part2'], $data['part3']);

        Voiture::create($data);

        // Flash message to the session
        $request->session()->forget('temp_photo_path');
        session()->flash('success', 'client ajoutée');
        session()->flash('subtitle', 'le client  a été ajoutée avec succès à la liste.');

        return redirect()->route('mechanic.clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();

        // Find the client by ID and ensure they belong to the mechanic's garage or were created by the mechanic
        $client = User::where(function ($query) use ($user) {
            // Clients from the mechanic's garage
            $query->whereHas('voitures', function ($query) use ($user) {
                $query->whereHas('operations', function ($operationQuery) use ($user) {
                    $operationQuery->whereHas('garage', function ($garageQuery) use ($user) {
                        $garageQuery->where('id', $user->garage_id);
                    });
                });
            })
                // Clients explicitly created by the mechanic
                ->orWhere(function ($query) use ($user) {
                    $query->where('created_by_mechanic', 1)
                        ->where('mechanic_id', $user->id);
                });
        })
            ->with('voitures.operations')
            ->find($id);

        // If the client is not found, redirect back with an error message
        if (!$client) {
            return back()->with('error', 'client introuvable ou n\'appartient pas à ce garage.');
        }
        Session::put('client', $client);
        return view('mechanic.clients.show', compact('client'));
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