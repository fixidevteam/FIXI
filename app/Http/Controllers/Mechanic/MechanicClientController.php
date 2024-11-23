<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MechanicClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Get search query
        $search = $request->input('search');

        // Fetch clients from the mechanic's garage based on search by name or email
        $clients = User::whereHas('voitures', function ($query) use ($user) {
            $query->whereHas('operations', function ($operationQuery) use ($user) {
                $operationQuery->whereHas('garage', function ($garageQuery) use ($user) {
                    $garageQuery->where('id', $user->garage_id);
                });
            });
        })
            ->when($search, function ($query, $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%'); // Add email to the search
                });
            })
            ->with('voitures.operations')
            ->get();

        return view('mechanic.clients.index', compact('clients', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();

        // Find the client by ID and ensure they belong to the mechanic's garage
        $client = User::whereHas('voitures', function ($query) use ($user) {
            $query->whereHas('operations', function ($operationQuery) use ($user) {
                $operationQuery->whereHas('garage', function ($garageQuery) use ($user) {
                    $garageQuery->where('id', $user->garage_id);
                });
            });
        })
            ->with('voitures.operations')
            ->find($id);

        // If the client is not found, redirect back with an error message
        if (!$client) {
            return back()->with('error', 'Voiture introuvable ou n\'appartient pas à ce garage.');
        }

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