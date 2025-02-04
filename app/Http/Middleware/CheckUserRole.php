<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, string $guard)
    {
        $user = Auth::guard($guard)->user();

        // If no user is authenticated, abort with 403 Unauthorized
        if (!$user) {
            Log::warning("Unauthorized access attempt (not logged in) for guard: {$guard}", ['route' => $request->route()]);
            abort(403, 'Unauthorized access.');
        
        }
        if ($guard !== 'web' && $guard !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        // Check if an Admin is trying to access Resident routes
        if ($user->usertype === 'Admin' && $request->is('resident/*')) {
            Log::info("Admin user attempting to access resident route. Redirecting to admin dashboard...", ['user_id' => $user->id, 'route' => $request->route()]);
            return redirect()->route('admin.dashboard');
        }

        // Check if a Resident is trying to access Admin routes
        if ($user->usertype === 'resident' && $request->is('admin/*')) {
            Log::info("Resident user attempting to access admin route. Redirecting to resident dashboard...", ['user_id' => $user->id, 'route' => $request->route()]);
            return redirect()->route('resident.dashboard');
        }


        return $next($request);
    }
}
