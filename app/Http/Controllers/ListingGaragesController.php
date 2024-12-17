<?php

namespace App\Http\Controllers;

use App\Models\garage;
use App\Models\Ville;
use Illuminate\Http\Request;

class ListingGaragesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch villes with garage count
        $villes = Ville::withCount(['garages' => function ($query) {
            $query->whereNull('user_id'); // Count only garages without user_id
        }])->get();

        // Search for garages based on the selected 'ville' and exclude those with 'user_id'
        $searchVille = $request->input('ville');
        $garages = Garage::when($searchVille, function ($query, $searchVille) {
            return $query->where('ville', $searchVille);
        })
            ->whereNull('user_id') // Exclude garages with a user_id
            ->paginate(10); // 10 items per page

        return view('userListingGarages.index', compact('garages', 'villes', 'searchVille'));
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
        $garage = garage::find($id);
        // dd($garage);
        return view('userListingGarages.show', compact('garage'));
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