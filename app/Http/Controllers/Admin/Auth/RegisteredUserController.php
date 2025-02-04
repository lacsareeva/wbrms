<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminArchiveFile\AdminArchiveAccounts;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class RegisteredUserController extends Controller
{
    public function index(Request $request): View
    {
        $admins = Admin::all();
        $admins = Admin::where('usertype', 'Staff')
            ->orderBy('id', 'desc')->get();
        return view('admin.accounts.accounts', compact('admins'));

    }

    public function create(): View
    {
        return view('admin.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'month' => ['required', 'string', 'max:255'],
            'day' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'usertype' => ['required', 'string', 'max:255'],
            'verification_id' => ['required', 'string', 'max:255'],
            'verification_id_number' => ['required', 'string', 'max:255'],
            'verification_id_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif.jfif', 'max:2048'],
        ]);
        $imagePath = $request->file('verification_id_image')->store('verification_images', 'public');

        $admins = Admin::create([
            'name' => $request->name,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'suffix' => $request->suffix,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'month' => $request->month,
            'day' => $request->day,
            'year' => $request->year,
            'gender' => $request->gender,
            'usertype' => $request->usertype,
            'verification_id' => $request->verification_id,
            'verification_id_number' => $request->verification_id_number,
            'verification_id_image' => $imagePath,

        ]);

        event(new Registered(user: $admins));

        Auth::guard('admin')->login($admins);

        return redirect()->route('admin.dashboard')->with('success', 'User created successfully.');

    }
    public function save(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'usertype' => ['nullable', 'string', 'max:255'],
        ]);
        $data = Admin::create($request->only(['name', 'mname', 'lname', 'suffix', 'password', 'email', 'usertype']));

        if ($data) {
            session()->flash('success', 'Accounts successfully added!');
            return redirect()->route('admin.accounts.accounts');
        } else {
            session()->flash('error', 'error occured');
            return redirect()->route('admin.accounts.accounts');
        }
    }

    public function delete($id): RedirectResponse
    {
        try {
            // Find the admin account to delete
            $admins = Admin::findOrFail($id);

            // Archive the admin account
            $archivedAccounts = new AdminArchiveAccounts();
            $archivedAccounts->name = $admins->name;
            $archivedAccounts->mname = $admins->mname;
            $archivedAccounts->lname = $admins->lname;
            $archivedAccounts->suffix = $admins->suffix;
            $archivedAccounts->email = $admins->email;
            $archivedAccounts->usertype = $admins->usertype;
            $archivedAccounts->status = 'Inactive';
            $archivedAccounts->personIncharge = auth()->user()->email ?? null; // Fixed typo
            $archivedAccounts->remove_at = now();
            $archivedAccounts->created_at = $admins->created_at;
            $archivedAccounts->save();

            // Delete the admin account
            if ($admins->delete()) {
                session()->flash('success', 'Accounts remove successfully!');
            } else {
                session()->flash('error', 'An error occurred while deleting the announcement.');
            }
        } catch (ModelNotFoundException $e) {
            session()->flash('error', 'Admin account not found.');
        } catch (\Exception $e) {
            session()->flash('error', 'An unexpected error occurred: ' . $e->getMessage());
        }

        return redirect()->route('admin.accounts.accounts');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'mname' => 'required|string',
            'lname' => 'required|string',
            'suffix' => 'nullable|string',
            'email' => 'required|email',
            'password' => 'nullable',
        ]);

        $admin = Admin::findOrFail($id);

        $admin->name = $request->input('name');
        $admin->mname = $request->input('mname');
        $admin->lname = $request->input('lname');
        $admin->suffix = $request->input('suffix');
        $admin->email = $request->input('email');

        // Update password only if a new one is provided
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->input('password'));
        }

        $admin->save();

        return redirect()->route('admin.accounts.accounts')
            ->with('success', 'Account updated successfully');
    }
}
