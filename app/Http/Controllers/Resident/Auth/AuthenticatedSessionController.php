<?php

namespace App\Http\Controllers\Resident\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('resident.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        try {
            // Attempt to authenticate
            $request->authenticate();

            // Flash success message
            session()->flash('success', 'Login successful!');

            // Redirect to intended URL or dashboard
            return redirect()->intended(route('resident.dashboard'));
        } catch (ValidationException $e) {
            // Handle validation exception
            if ($e->getMessage() === 'Your account is not verified. Please contact the administrator.') {
                return back()->withErrors(['email' => 'Your account is not verified. Please wait for the admin to verify.'])->withInput();
            }

            // For other login errors
            return back()->withErrors(['email' => 'Invalid login credentials.'])->withInput();
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/resident/login');
    }
}
