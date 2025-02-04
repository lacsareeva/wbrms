<?php

namespace App\Http\Controllers\Resident\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Residents;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('resident.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mname' => ['nullable', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'], // Added unique validation for email
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'usertype' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'month' => ['nullable', 'string', 'max:255'],
            'day' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'max:255'],
            'residenttype' => ['nullable', 'string', 'max:255'],
            'age' => ['nullable', 'string', 'max:255'],
            'verificationInfo' => ['nullable', 'string', 'max:255'],
            'verification_id' => ['nullable', 'string', 'max:255'],
            'verification_id_number' => ['nullable', 'string', 'max:255'],
            'verification_id_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,jfif', 'max:2048'], // Fixed MIME types
        ]);

        // Handle the file upload if an image is provided
        $imagePath = null;
        if ($request->hasFile('verification_id_image')) {
            $imagePath = $request->file('verification_id_image')->store('verification_images', 'public');
        }

        // Create a new resident record
        $resident = User::create([
            'name' => $request->name,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'suffix' => $request->suffix,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => $request->usertype,
            'address' => $request->address,
            'month' => $request->month,
            'day' => $request->day,
            'year' => $request->year,
            'gender' => $request->gender,
            'residenttype' => $request->residenttype,
            'age' => $request->age,
            'verificationInfo' => "not verified",
            'verification_id' => $request->verification_id,
            'verification_id_number' => $request->verification_id_number,
            'verification_id_image' => $imagePath, // Save the uploaded file path
        ]);

        // Fire Registered event if necessary
        event(new Registered($resident));

        // Log the user in
        Auth::login($resident);

        // Redirect to the login page with a success message
        return redirect()->route('resident.login')->with('success', 'User created successfully. Please wait for the admin to verify your account.');
    }
}
