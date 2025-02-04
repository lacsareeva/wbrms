<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\AdminBorrowed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ResidentBorrowedController extends Controller
{
    public function show(): View
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized access');
        }

        $borrowed = AdminBorrowed::where('sender', Auth::user()->email)->orderBy('id', 'desc')->get();

        return view('resident.borrowed.borrowed', compact('borrowed'));

    }

    public function save(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'equipment' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'string', 'max:255'],
            'purpose' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'borrow-date' => ['required', 'date'],
            'return-date' => ['required', 'date', 'after:borrow-date'], // Ensure return-date is after borrow-date
            'sender' => ['required', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:255'],
            'response' => ['nullable'],
        ]);

        // Additional validation to check if borrow-date and return-date are equal
        if ($request->input('borrow-date') === $request->input('return-date')) {
            return redirect()->back()->withErrors([
                'return-date' => 'The return date must be different from the borrow date.',
            ])->withInput();
        }

        // Save data to the database
        $data = AdminBorrowed::create($request->only([
            'name',
            'address',
            'equipment',
            'quantity',
            'purpose',
            'contact',
            'borrow-date',
            'return-date',
            'sender',
            'status',
            'response'
        ]));

        if ($data) {
            session()->flash('success', 'Borrowed request successfully submitted!');
            return redirect()->route('resident.borrowed.borrowed');
        } else {
            session()->flash('error', 'An error occurred.');
            return redirect()->route('resident.borrowed.borrowed');
        }
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'equipment' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'string', 'max:255'],
            'purpose' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'borrow-date' => ['required', 'date'],
            'return-date' => ['required', 'date'],
            'sender' => ['required', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:255'],
            'response' => ['nullable'],
        ]);

        // Find the announcement and update it
        $borrowed = AdminBorrowed::findOrFail($id);
        $borrowed->update($request->all());

        // Redirect back with success message
        return redirect()->route('resident.borrowed.borrowed')
            ->with('success', 'Borrowed request updated successfully!');
    }
}
