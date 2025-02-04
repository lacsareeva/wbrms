<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureCorrectGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated as admin
        if (!Auth::guard('admin')->check()) {
            return redirect('/unauthorized')->with('error', 'Access denied.');
        } 
        return $next($request);
    }
}

