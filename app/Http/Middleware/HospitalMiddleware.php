<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HospitalMiddleware
{
    /**
     * Handle an incoming request.
     * Ensures only users with 'hospital' role can access hospital routes.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * Check if user is logged in.
         */
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        /**
         * Check if user has 'hospital' role.
         * Also verify hospital account is approved (optional additional security).
         * Note: Hospital status check in Hospital model would be: auth()->user()->hospital->status == 'approved'
         */
        if (!auth()->user()->hasRole('hospital')) {
            return redirect()->route('dashboard')
                ->with('error', 'Access denied. Hospital account required.');
        }

        return $next($request);
    }
}
