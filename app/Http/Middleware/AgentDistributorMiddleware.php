<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentDistributorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->isAgent() || auth()->user()->isDistributor()) {
            return $next($request);
        }
        Auth::logout();
        return redirect()->route('login.index')->with('error','ليس لديك صلاحية !');

    }
}
