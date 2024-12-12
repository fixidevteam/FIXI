<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Quartier;
use App\Models\User;
use App\Models\Ville;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $villes = Ville::all();
        $selectedVille = old('ville');
        $quartiers = $selectedVille ? Quartier::where('ville_id', $selectedVille)->get() : collect();

        return view('auth.register', compact('villes', 'quartiers'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'telephone' => [
                'required',
                'string',
                'max:20',
                'regex:/^(\+2126\d{8}|\+2127\d{8}|06\d{8}|07\d{8})$/',
            ],
            'ville' => ['required', 'string'],
            'quartier' => ['nullable'],
        ]);

        // Fetch the ville name based on the ID
        $ville = Ville::findOrFail($request->ville);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'ville' => $ville->ville, // Store the city name
            'quartier' => $request->quartier,
        ]);

        event(new Registered($user));

        Auth::login($user);
        // Send email verification notification
        // $request->user()->sendEmailVerificationNotification();

        return redirect(RouteServiceProvider::HOME);
    }
}