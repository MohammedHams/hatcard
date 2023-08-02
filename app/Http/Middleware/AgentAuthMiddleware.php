<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AgentAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            // Check if the user role is 'agent'
            if ($user->role === 'agent') {
                // User is authenticated and has the 'agent' role, proceed with the request
                return $next($request);
            }
        }

        // User is not authenticated or does not have the 'agent' role, redirect or return an error response as needed
        return redirect()->route('login.index')->with('error','لا توجد صلاحية لك على هذا النظام');
    }
}
