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
    private const DASHBOARD_ROUTE = '/fixi-plus/dashboard';

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                if ($user->provider === $provider && $user->provider_id === $socialUser->getId()) {
                    Auth::login($user);

                    if (empty($user->telephone) || empty($user->ville)) {
                        return redirect('/fixi-plus/complete-profile');
                    }

                    return redirect(self::DASHBOARD_ROUTE);
                } else {
                    return redirect('/fixi-plus/login')->withErrors([
                        'email' => 'Cette adresse email est déjà utilisée par un autre mode de connexion. Veuillez utiliser ce mode ou un autre email.',
                    ]);
                }
            }

            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'provider_token' => $socialUser->token,
            ]);

            Auth::login($user);
            if (empty($user->telephone) || empty($user->ville)) {
                return redirect('/fixi-plus/complete-profile');
            }

            return redirect(self::DASHBOARD_ROUTE);
        } catch (\Exception $e) {
            return redirect('/fixi-plus/login')->withErrors([
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
                'regex:/^(06\d{8}|07\d{8})$/',
            ],
            'ville' => 'required|string',
        ]);

        $user = Auth::user();

        $user->update([
            'telephone' => $request->telephone,
            'ville' => $request->ville,
        ]);

        // Send email verification notification
        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
        }

        return redirect(self::DASHBOARD_ROUTE);
    }
}