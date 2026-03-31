<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * Ensures only users with 'admin' role can access admin routes.
     * Redirects non-admin users to appropriate pages.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * Check if user is authenticated.
         * If not, redirect to login page.
         */
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        /**
         * Check if authenticated user has 'admin' role using Spatie Permission.
         * The hasRole() method is provided by HasRoles trait in User model.
         */
        if (!auth()->user()->hasRole('admin')) {
            /**
             * User is authenticated but doesn't have admin role.
             * Redirect to appropriate dashboard based on their actual role.
             * Could also abort with 403 (Forbidden) error.
             */
            return redirect()->route('dashboard')
                ->with('error', 'Access denied. Admin privileges required.');
        }

        /**
         * User is authenticated and has admin role.
         * Allow the request to proceed.
         */
        return $next($request);
    }
}
