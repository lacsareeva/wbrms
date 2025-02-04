<?php

namespace App\Http\Controllers;
use App\Models\AdminArchiveFile\AdminArchivedBlotter;
use App\Models\AdminBlotter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
class AdminBlotterController extends Controller
{
    public function index(Request $request): View
    {
        $blotter = AdminBlotter::all();
        $blotter = AdminBlotter::orderBy('id', 'desc')->get();
        return view('admin.blotter.blotter', compact('blotter'));
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
            'sender'  => ['required', 'string', 'max:255'],
          
        ]);
        $data = AdminBlotter::create($request->only(['incident_report', 'address', 'datetimes', 'nameofcomplainant', 'witness1','witness2','narrative','sender']));

        if ($data) {
            session()->flash('success', 'Blotter report successfully added!');
            return redirect()->route('admin.blotter.blotter');
        } else {
            session()->flash('error', 'error occured');
            return redirect()->route('admin.blotter.blotter');
        }
    }
    public function delete($id): RedirectResponse
    {
        try {
            $blotters = AdminBlotter::findOrFail($id);
            
            $archivedBlotter = new AdminArchivedBlotter();
            $archivedBlotter->incident_report = $blotters->incident_report;
            $archivedBlotter->address = $blotters->address;
            $archivedBlotter->datetimes = $blotters->datetimes;
            $archivedBlotter->nameofcomplainant = $blotters->nameofcomplainant;
            $archivedBlotter->witness1 = $blotters->witness1;
            $archivedBlotter->witness2 = $blotters->witness2;
            $archivedBlotter->narrative = $blotters->narrative;
            $archivedBlotter->sender = $blotters->sender;
            $archivedBlotter->created_at = $blotters->created_at;
            $archivedBlotter->settled_at = now();
            $archivedBlotter->personIncharge = auth()->user()->name;
            $archivedBlotter->save();
    
            $blotters->delete();
    
            session()->flash('success', 'Blotter report successfully settled!');
        } catch (ModelNotFoundException $e) {
            session()->flash('error', 'Blotter report not found.');
        } catch (\Exception $e) {
            session()->flash('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    
        return redirect()->route('admin.blotter.blotter');
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
        return redirect()->route('admin.blotter.blotter')
            ->with('success', 'Blotter file updated successfully!');
    }
    
}
