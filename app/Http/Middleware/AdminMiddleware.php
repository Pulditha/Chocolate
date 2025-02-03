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
            // Check if the user is trying to access any admin route
            if ($request->is('admin/*') && Auth::user()->role !== 'admin') {
                // Redirect unauthorized users to homepage
                return redirect('/')->with('error', 'Unauthorized access.');
            }

            // Allow access if the user is an admin
            return $next($request);
        }

        // If the user is not logged in and trying to access any admin route
        if ($request->is('admin/*')) {
            return redirect('/login')->with('error', 'Please log in to access the admin panel.');
        }

        // Allow access to other routes
        return $next($request);
    }
}
