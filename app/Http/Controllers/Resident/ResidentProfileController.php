<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ResidentProfileController extends Controller
{
   
    public function show(): View
    {
        return view('resident.profile.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'age' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'residenttype' => 'nullable|string|max:255',
        ]);
    
        $user = auth()->user();
        $user->update($request->only(['name', 'mname', 'lname', 'suffix', 'email','address','age','gender','residenttype']));
    
        return redirect()->route('resident.profile.profile')->with('success', 'Profile updated successfully.');
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);
    
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
    
        $user = auth()->user();
        $user->update(['password' => Hash::make($request->password)]);
    
        return redirect()->route('resident.profile.profile')->with('success', 'Password updated successfully.');
    }   
}
