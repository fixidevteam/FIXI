<?php

namespace App\Http\Controllers\Mechanic\Auth;

use App\Http\Controllers\Controller;
use App\Models\garage;
use App\Models\Mechanic;
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
        $garages = garage::all();

        return view('mechanic.auth.register', compact('garages'));
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Mechanic::class],
            'garage_id' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'telephone' => [
                'required',
                'string',
                'max:20',
                'regex:/^(\+2126\d{8}|\+2127\d{8}|06\d{8}|07\d{8})$/',
            ],
        ]);

        $mechanic = Mechanic::create([
            'name' => $request->name,
            'email' => $request->email,
            'garage_id' => $request->garage_id,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone,
        ]);

        event(new Registered($mechanic));

        Auth::guard('mechanic')->login($mechanic);
        return redirect(route('mechanic.dashboard', absolute: false));
    }
}