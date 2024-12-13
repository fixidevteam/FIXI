<?php

namespace App\Http\Controllers\Mechanic\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\MechanicLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('mechanic.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(MechanicLoginRequest $request): RedirectResponse
    {
        // Get the mechanic attempting to log in
        $mechanic = \App\Models\Mechanic::where('email', $request->email)->first();

        // Check if the mechanic exists and if their account is inactive
        if ($mechanic && !$mechanic->status) {
            return back()->withErrors([
                'email' => 'Votre compte est inactif. Veuillez contacter l\'administrateur.',
            ]);
        }

        $request->authenticate();

        $request->session()->regenerate();
        return redirect()->intended(route('mechanic.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('mechanic')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}