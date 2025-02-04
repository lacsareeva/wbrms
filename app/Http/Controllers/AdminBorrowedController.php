<?php

namespace App\Http\Controllers;
use App\Models\AdminBorrowed;
use App\Models\AdminArchiveFile\AdminArchiveBorrowed;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class AdminBorrowedController extends Controller
{
    public function index(Request $request): View
    {
        $borrowed = AdminBorrowed::all();
        $borrowed = AdminBorrowed::orderBy('id', 'desc')->get();
        return view('admin.borrowed.borrowed', compact('borrowed'));
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
            session()->flash('success', 'Borrowed request successfully added!');
            return redirect()->route('admin.borrowed.borrowed');
        } else {
            session()->flash('error', 'An error occurred.');
            return redirect()->route('admin.borrowed.borrowed');
        }
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        try {

            $request->validate([
                'status' => 'required|in:rejected,Accepted',
                'response' => 'required',
            ]);

            $borroweds = AdminBorrowed::findOrFail($id);

            $archivedBorrowed = new AdminArchiveBorrowed();
            $archivedBorrowed->name = $borroweds->name;
            $archivedBorrowed->address = $borroweds->address;
            $archivedBorrowed->equipment = $borroweds->equipment;
            $archivedBorrowed->quantity = $borroweds->quantity;
            $archivedBorrowed->purpose = $borroweds->purpose;
            $archivedBorrowed->contact = $borroweds->contact;
            $archivedBorrowed->{'borrow-date'} = $borroweds->{'borrow-date'};
            $archivedBorrowed->{'return-date'} = $borroweds->{'return-date'};
            $archivedBorrowed->sender = $borroweds->sender;
            $archivedBorrowed->created_at = $borroweds->created_at;
            $status = $request->input('status', 'Rejected');
            $response = $request->input('response');

            $archivedBorrowed->status = $status;
            $archivedBorrowed->response = $response;

            $archivedBorrowed->returned_at = now();
            $archivedBorrowed->personIncharge = auth()->user()->email;
            $archivedBorrowed->save();

            $borroweds->delete();

            session()->flash('success', 'Your response was successfully submitted!');
        } catch (ModelNotFoundException $e) {
            session()->flash('error', ' response not found.');
        } catch (\Exception $e) {
            session()->flash('error', 'An unexpected error occurred: ' . $e->getMessage());
        }

        return redirect()->route('admin.borrowed.borrowed');
    }

    public function deletes($id): RedirectResponse
    {
        try {
            $borroweds = AdminBorrowed::findOrFail($id);

            $archivedBorrowed = new AdminArchiveBorrowed();
            $archivedBorrowed->name = $borroweds->name;
            $archivedBorrowed->address = $borroweds->address;
            $archivedBorrowed->equipment = $borroweds->equipment;
            $archivedBorrowed->quantity = $borroweds->quantity;
            $archivedBorrowed->purpose = $borroweds->purpose;
            $archivedBorrowed->contact = $borroweds->contact;
            $archivedBorrowed->{'borrow-date'} = $borroweds->{'borrow-date'};
            $archivedBorrowed->{'return-date'} = $borroweds->{'return-date'};
            $archivedBorrowed->sender = $borroweds->sender;
            $archivedBorrowed->created_at = $borroweds->created_at;
            $archivedBorrowed->status = 'returned';
            $archivedBorrowed->returned_at = now();
            $archivedBorrowed->personIncharge = auth()->user()->email;
            $archivedBorrowed->save();

            $borroweds->delete();

            session()->flash('success', 'equipment return!');
        } catch (ModelNotFoundException $e) {
            session()->flash('error', ' response not found.');
        } catch (\Exception $e) {
            session()->flash('error', 'An unexpected error occurred: ' . $e->getMessage());
        }

        return redirect()->route('admin.borrowed.borrowed');
    }
    public function updates(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255',
            'response' => 'nullable|string|max:1000',
        ]);

        // Find the record by ID
        $borroweds = AdminBorrowed::findOrFail($id);

        // Update the record's data
        $borroweds->status = $request->input('status', 'Accepted');
        $borroweds->response = $request->input('response');
        $borroweds->update($request->all());

        return redirect()->route('admin.borrowed.borrowed')
            ->with('success', 'Borrowed request accepted successfully!');
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
        return redirect()->route('admin.borrowed.borrowed')
            ->with('success', 'Borrowed request updated successfully!');
    }

}
