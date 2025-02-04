<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Check if the user's email is already verified
        if ($request->user()->hasVerifiedEmail()) {
            // Redirect to the intended route or dashboard
            return redirect()->route('admin.dashboard');
        }

        // Mark the email as verified
        if ($request->user()->markEmailAsVerified()) {
            // Fire the Verified event
            event(new Verified($request->user()));
        }

        // After email verification, redirect to the dashboard
        return redirect()->route('admin.dashboard');
    }
}
