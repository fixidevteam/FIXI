<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\type_papierv;
use Illuminate\Http\Request;

class AdminGestionPapierVoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type_papierVoitures = type_papierv::all();
        return view('admin.gestionPapierVoiture.index',compact('type_papierVoitures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gestionPapierVoiture.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type = $request->validate(['type'=>['required']]);
        if($type){
            type_papierv::create($type);
            return redirect()->route('admin.gestionPapierVoiture.index');
    
        }
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
        $type = type_papierv::find($id);
        return view('admin.gestionPapierVoiture.edit',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $papier = $request->validate(['type'=>['required']]);
        $type = type_papierv::find($id);
        // dd($type);
        if($type){
                $type->update($papier);
        }
        return redirect()->route('admin.gestionPapierVoiture.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = type_papierv::find($id);
        // dd($type);
        if($type){
                $type->delete();
        }
        return redirect()->route('admin.gestionPapierVoiture.index');
    }
}