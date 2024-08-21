<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class GuestGeneral
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if both the user (web) and admin guards are guests
        if (Auth::guard('web')->guest() && Auth::guard('admin')->guest()) {
            // Allow the request to proceed if both are guests
            return $next($request);
        }

        // Redirect based on the type of user logged in
        if (Auth::guard('web')->check()) {
            return redirect()->route('dashboard'); // Authenticated user is redirected to user dashboard
        }

        if (Auth::guard('admin')->check()) {
            return redirect()->route('adminDashboard'); // Authenticated admin is redirected to admin dashboard
        }

        // Default redirect (optional)
        return redirect()->route('/');
    }
}
