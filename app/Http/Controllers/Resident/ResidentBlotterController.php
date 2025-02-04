<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\AdminBlotter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ResidentBlotterController extends Controller
{
  public function index(Request $request): View
  {
    if (!Auth::check()) {
      abort(403, 'Unauthorized access');
    }

    $blotter = AdminBlotter::where('sender', Auth::user()->email)->orderBy('id', 'desc')->get();

    return view('resident.blotter.blotter', compact('blotter'));
  }
  public function save(Request $request): RedirectResponse
  {
    $request->validate([

      'incident_report' => ['required', 'string', 'max:255'],
      'address' => ['required', 'string', 'max:255'],
      'datetimes' => ['required', 'string', 'max:255'],
      'nameofcomplainant' => ['required', 'string', 'max:255'],
      'witness1' => ['nullable', 'string', 'max:255'],
      'witness2' => ['nullable', 'string', 'max:255'],
      'narrative' => ['required', 'string', 'max:255'],
      'sender' => ['required', 'string', 'max:255'],

    ]);
    $data = AdminBlotter::create($request->only(['incident_report', 'address', 'datetimes', 'nameofcomplainant', 'witness1', 'witness2', 'narrative', 'sender']));

    if ($data) {
      session()->flash('success', 'Blotter request successfully submited!');
      return redirect()->route('resident.blotter.blotter');
    } else {
      session()->flash('error', 'error occured');
      return redirect()->route('resident.blotter.blotter');
    }
  }

  public function update(Request $request, $id): RedirectResponse
  {
    $request->validate([
      'incident_report' => ['required', 'string', 'max:255'],
      'address' => ['required', 'string', 'max:255'],
      'datetimes' => ['required', 'string', 'max:255'],
      'nameofcomplainant' => ['required', 'string', 'max:255'],
      'witness1' => ['nullable', 'string', 'max:255'],
      'witness2' => ['nullable', 'string', 'max:255'],
      'narrative' => ['required', 'string', 'max:255'],
      'sender' => ['required', 'string', 'max:255'],
    ]);

    // Find the announcement and update it
    $blotter = AdminBlotter::findOrFail($id);
    $blotter->update($request->all());

    // Redirect back with success message
    return redirect()->route('resident.blotter.blotter')
      ->with('success', 'Blotter request updated successfully!');
  }
}
