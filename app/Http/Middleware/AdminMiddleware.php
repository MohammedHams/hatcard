<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            // Check if the user role is 'agent'
            if ($user->role === 'admin') {
                // User is authenticated and has the 'agent' role, proceed with the request
                return $next($request);
            }
        }

        Auth::logout();
        return redirect()->route('login.index')->with('error','ليس لديك صلاحية !');
    }
}
