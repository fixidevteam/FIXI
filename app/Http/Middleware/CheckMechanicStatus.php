<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMechanicStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check() && !Auth::user()->status) {
            Auth::logout(); // Log out the inactive user
            return redirect('/mechanic/login')->withErrors([
                'email' => 'Votre compte est inactif. Veuillez contacter l\'administrateur.',
            ]);
        }

        return $next($request);
    }
}