<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PatientMiddleware
{
    /**
     * Handle an incoming request.
     * Ensures only users with 'patient' role can access patient routes.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * Verify user is authenticated.
         */
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        /**
         * Check for 'patient' role.
         */
        if (!auth()->user()->hasRole('patient')) {
            return redirect()->route('dashboard')
                ->with('error', 'Access denied. Patient account required.');
        }

        return $next($request);
    }
}
