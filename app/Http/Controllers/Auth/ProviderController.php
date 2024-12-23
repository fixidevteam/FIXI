<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        try {
            // Retrieve the user's information from the provider
            $socialUser = Socialite::driver($provider)->user();

            // Check if a user with the same email exists in the database
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                // If the user exists, check if it matches the same provider
                if ($user->provider === $provider && $user->provider_id === $socialUser->getId()) {
                    // Log the user in if it's the same provider and ID
                    Auth::login($user);

                    // Redirect to profile completion if telephone or ville is missing
                    if (empty($user->telephone) || empty($user->ville)) {
                        return redirect('/my-fixi/complete-profile');
                    }

                    return redirect('/my-fixi/dashboard');
                } else {
                    // If the email exists but not the same provider, show an error
                    return redirect('/my-fixi/login')->withErrors([
                        'email' => 'Cette adresse email est déjà utilisée par un autre mode de connexion. Veuillez utiliser ce mode ou un autre email.',
                    ]);
                }
            }

            // If the user doesn't exist, create a new account
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'provider_token' => $socialUser->token,
                'email_verified_at' => now(),
            ]);

            // Log the user in
            Auth::login($user);

            // Redirect to profile completion if telephone or ville is missing
            if (empty($user->telephone) || empty($user->ville)) {
                return redirect('/my-fixi/complete-profile');
            }

            return redirect('/my-fixi/dashboard');
        } catch (\Exception $e) {
            return redirect('/my-fixi/login')->withErrors([
                'error' => 'Une erreur s\'est produite lors de la connexion. Veuillez réessayer.',
            ]);
        }
    }

    public function showCompleteProfileForm()
    {
        $villes = Ville::all();
        return view('auth.complete-profile', compact('villes'));
    }

    public function completeProfile(Request $request)
    {
        $request->validate([
            'telephone' => [
                'required',
                'string',
                'max:20',
                'regex:/^(\+2126\d{8}|\+2127\d{8}|06\d{8}|07\d{8})$/',
            ],
            'ville' => 'required|string',
        ]);

        $user = Auth::user();
        $user->update([
            'telephone' => $request->telephone,
            'ville' => $request->ville,
        ]);

        return redirect('/my-fixi/dashboard');
    }
}