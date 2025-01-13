<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MechanicPromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $garageId = Auth::user()->garage_id; // Assuming the user has a garage_id field

        $activePromotions = Promotion::whereHas('garage', function ($query) use ($garageId) {
            $query->where('id', $garageId);
        })
            ->where('date_fin', '>=', Carbon::now())
            ->orderBy('date_fin', 'asc') // Promotions actives par ordre croissant
            ->get();

        $expiredPromotions = Promotion::whereHas('garage', function ($query) use ($garageId) {
            $query->where('id', $garageId);
        })
            ->where('date_fin', '<', Carbon::now())
            ->orderBy('date_fin', 'desc') // Promotions expirées par ordre décroissant
            ->paginate(15);

        return view('mechanic.promotions.index', compact('activePromotions', 'expiredPromotions'));
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
