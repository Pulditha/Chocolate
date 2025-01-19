<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Check if the user is trying to access the admin dashboard
            if ($request->is('admin/dashboard') && Auth::user()->role !== 'admin') {
                // Redirect to homepage with an error message for unauthorized access
                return redirect('/');
            }

            // Allow access if the user is an admin or not accessing admin routes
            return $next($request);
        }

        // If the user is not logged in and trying to access admin/dashboard
        if ($request->is('admin/dashboard')) {
            return redirect('/login')->with('error', 'Please log in to access the admin dashboard.');
        }

        // Allow access to non-authenticated routes
        return $next($request);
    }
}
