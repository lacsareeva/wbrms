<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\AdminRecords;
use Illuminate\Support\Facades\Auth;

class ResidentRecordController extends Controller
{
   
    public function show(): View
    {
     
        $records = AdminRecords::where('sender', Auth::user()->email)->orderBy('id', 'desc')->get();

        return view('resident.record.record', compact('records'));

    }

    public function save(Request $request): RedirectResponse
    {
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'age' => ['nullable', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'purpose' => ['nullable', 'string', 'max:255'],
            'sender' => ['nullable', 'string', 'max:255'],
            'requirement' => ['nullable', 'string', 'max:255'],
            'requesttype' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:255'],
        ]);
        $data = AdminRecords::create($request->only(['fullname', 'age', 'address', 'purpose','sender', 'requirement', 'requesttype', 'status']));

        if ($data) {
            session()->flash('success', 'Records successfully added!');
            return redirect()->route('resident.record.record');
        } else {
            session()->flash('error', 'error occured');
            return redirect()->route('resident.record.record');
        }
    }

    public function update(Request $request, $id): RedirectResponse
    {

        $validatedData = $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'age' => ['nullable', 'integer'], 
            'address' => ['required', 'string', 'max:255'],
            'purpose' => ['nullable', 'string', 'max:255'],
            'requirement' => ['nullable', 'string', 'max:255'],
        ]);

 
        $record = AdminRecords::findOrFail($id);

        $record->update(array_merge($validatedData, ['created_at' => now()]));

        return redirect()->route('resident.record.record')
            ->with('success', 'Document request updated successfully!');
    }
}
