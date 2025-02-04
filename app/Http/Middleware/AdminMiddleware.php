<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) { //Check if user is logged in AND has admin role
            Log::warning("Unauthorized access attempt to admin dashboard.");
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}