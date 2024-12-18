<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Quartier;
use App\Models\Ville;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        // Fetch all villes for the dropdown
        $villes = Ville::all();

        // Get the ville_id corresponding to the user's ville name
        $userVille = Ville::where('ville', $user->ville)->first();

        // Fetch quartiers if the user already has a ville
        $quartiers = $user->ville
            ? Quartier::where('ville_id', $user->ville)->get()
            : [];

        return view('profile.edit', [
            'user' => $user,
            'villes' => $villes,
            'quartiers' => $quartiers,
            'userVilleId' => $userVille?->id,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Fetch the ville name based on the submitted ID
        $ville = Ville::where('id', $request->ville)->firstOrFail();

        // Update the user's information
        $user = $request->user();
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'ville' => $ville->ville, // Store the name of the city
            'quartier' => $request->quartier, // Update quartier directly
        ]);

        // If email is updated, reset email verification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}