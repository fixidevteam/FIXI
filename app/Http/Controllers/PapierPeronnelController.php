<?php

namespace App\Http\Controllers;

use App\Models\UserPapier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PapierPeronnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $papiers = UserPapier::where('user_id', $user_id)->get();
        return view('userPaiperPersonnel.paiperPersonnel',compact('papiers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("userPaiperPersonnel.AjouterPaiperPersonnel");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->validate([
            'type' => ['required','max:30'],
            'note' =>['max:255'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date'],
            
        ]);
        // dd($data['note']);
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('user/papierperso', 'public');
            $data['photo'] = $imagePath;
        }
        $data['user_id'] = $user_id;
        UserPapier::create($data);
        return redirect()->route('paiperPersonnel.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $papier = UserPapier::find($id);
        if (!$papier || $papier->user_id != auth()->id()) {
            abort(403);
        }
        return view('userPaiperPersonnel.details',compact('papier'));
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
