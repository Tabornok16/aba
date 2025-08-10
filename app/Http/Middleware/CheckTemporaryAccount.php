<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckTemporaryAccount
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isTemporary()) {
            if (Auth::user()->isExpired()) {
                Auth::logout();
                return redirect()->route('login')
                    ->with('error', 'Your temporary account has expired. Please contact an administrator.');
            }

            // If not expired but not approved, show temporary dashboard
            if (Auth::user()->isPending()) {
                return redirect()->route('temporary.dashboard');
            }
        }

        return $next($request);
    }
}
