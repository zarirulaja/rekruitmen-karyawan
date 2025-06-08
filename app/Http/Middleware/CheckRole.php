<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            if (Auth::check()) {
                // If logged in but wrong role, redirect based on actual role
                if (Auth::user()->role === 'hrd') {
                    return redirect()->route('hrd.dashboard');
                } else {
                    return redirect()->route('dashboard');
                }
            }
            
            // Not logged in
            return redirect()->route('login');
        }

        return $next($request);
    }
} 