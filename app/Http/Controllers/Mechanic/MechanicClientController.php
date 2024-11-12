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

        // Fetch clients from the mechanic's garage based on search by name
        $clients = User::whereHas('voitures', function ($query) use ($user) {
            $query->whereHas('operations', function ($operationQuery) use ($user) {
                $operationQuery->whereHas('garage', function ($garageQuery) use ($user) {
                    $garageQuery->where('id', $user->garage_id);
                });
            });
        })
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%'); // Search by client name
        })
        ->with('voitures.operations')
        ->get();
        
        // dd($clients);
        
        return view('mechanic.clients.index',compact('clients','search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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