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
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access the admin area.');
        }

        // Optional: Check if the user has admin role if you have roles set up
        // if (!Auth::user()->hasRole('admin')) {
        //     return redirect()->route('home')->with('error', 'You do not have permission to access this area.');
        // }

        return $next($request);
    }
}
