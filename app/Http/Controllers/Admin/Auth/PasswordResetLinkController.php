<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\AdminOtp;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
class PasswordResetLinkController extends Controller
{
    // Show the forgot password form
    public function showForgotPasswordForm()
    {
        return view('admin.auth.forgot-password');
    }

    // Send OTP
    public function sendOtp(Request $request)
    {
        // Validate email input
        $request->validate(['email' => 'required|email']);

        // Check if an OTP was recently sent and still valid
        $existingOtp = AdminOtp::where('email', $request->email)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($existingOtp) {
            return back()->with('otpError', 'Please wait at least 3 minute before requesting another OTP.');
        }

        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);

        // Save OTP to the database
        AdminOtp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(3), // OTP valid for 5 minutes
        ]);

        // Save email in the session for later verification
        $request->session()->put('email', $request->email);

        // Send OTP via email
        Mail::raw("Your OTP is: $otp", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Your OTP for Password Reset');
        });

        // Redirect to OTP verification page
        return redirect()->route('admin.verify-otp')->with('message', 'OTP has been sent to your email.');
    }
    public function showVerifyOTPForm()
    {
        return view('admin.auth.verify-otp');
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        // Validate the OTP field
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        // Retrieve the email from the session (ensure the email is saved during OTP sending)
        $email = $request->session()->get('email');
        if (!$email) {
            return redirect()->route('admin.auth.verify-otp')->withErrors(['email' => 'Session expired or email not found.']);
        }

        // Retrieve the OTP record from the database
        $otpRecord = AdminOtp::where('email', $email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($otpRecord) {
            // OTP is valid, delete it from the database
            $otpRecord->delete();

            // Redirect to password reset page
            return redirect()->route('admin.password.reset', ['email' => $otpRecord->email])->with('message', 'otp verification successfull.');
        }

        // If OTP is invalid or expired
        return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }

    // Show the reset password form
    public function showResetPasswordForm($email)
    {
        return view('admin.auth.reset-password', ['email' => $email]);
    }

    // Handle the password reset
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed', // Password confirmation
        ]);

        // Find the user by email
        $user = Admin::where('email', $request->email)->first();

        if ($user) {
            // Update the user's password
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('admin.login')->with('message', 'Password has been successfully reset.');
        }
        return back()->with('otpError', 'No user found with that email address.');
    }
}
