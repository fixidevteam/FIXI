<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MechanicOperatioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Fetch the authenticated mechanic's operations via their garage
        $operations = Operation::whereHas('garage', function ($query) use ($user) {
            $query->where('id', $user->garage_id);
        })
        ->with('voiture')
        ->get();
        // dd($operations);
        return view('mechanic.operations.index',compact('operations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mechanic.operations.create');
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
        return view('mechanic.operations.show');
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