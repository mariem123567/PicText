<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AuthGeneral
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if either the user (web) or admin guard is authenticated
        if (Auth::guard('web')->check() || Auth::guard('admin')->check()) {
            // Allow the request to proceed if authenticated as either a user or admin
            return $next($request);
        }

        // Redirect to the login page if not authenticated
        return redirect()->route('login'); // or another appropriate route
    }
}
