<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminRecords;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\AdminArchiveFile\AdminArchivedRecords;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage; // Import the Storage facade
use Vite;
class AdminRecordsController extends Controller
{
    public function index(Request $request): View
    {
        $records = AdminRecords::all();
        $records = AdminRecords::orderBy('id', 'desc')->get();
        return view('admin.records.records', compact('records'));
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
            return redirect()->route('admin.records.records');
        } else {
            session()->flash('error', 'error occured');
            return redirect()->route('admin.records.records');
        }
    }

    public function generateCertificatePDF(Request $request, $id)
    {
        $request->validate([
            'status' => 'nullable|string|max:255',
        ]);

        $record = AdminRecords::findOrFail($id);

        $record->update([
            'status' => $request->input('status', 'accepted'),
        ]);

        $data = [
            'fullname' => $record->fullname,
            'age' => $record->age,
            'address' => $record->address,
            'purpose' => $record->purpose,
            'day' => now()->format('jS'),
            'month' => now()->format('F'),
            'year' => now()->format('Y'),
        ];

        $pdf = Pdf::loadView('admin.records.IndigencyCertificate', $data)
            ->setPaper('a4', 'portrait')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);

        $fileName = 'Indigency_Certificate_' . $record->fullname . '.pdf';
        $filePath = storage_path('app/public/' . $fileName);
        $pdf->save($filePath);

        return redirect()->route('admin.records.records')
            ->with('success', 'Certificate generated successfully!')
            ->with('downloadUrl', asset('storage/' . $fileName));
    }

    public function generateCertificateRESIDENCYPDF(Request $request, $id)
    {
        $request->validate([
            'status' => 'nullable|string|max:255',
        ]);

        $record = AdminRecords::findOrFail($id);

        $record->update([
            'status' => $request->input('status', 'accepted'),
        ]);

        $data = [
            'fullname' => $record->fullname,
            'age' => $record->age,
            'address' => $record->address,
            'day' => now()->format('jS'),
            'month' => now()->format('F'),
            'year' => now()->format('Y'),
        ];

        $pdf = Pdf::loadView('admin.records.ResidencyCertificate', $data)
            ->setPaper('a4', 'portrait')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);

        $fileName = 'Residency_Certificate_' . $record->fullname . '.pdf';
        $filePath = storage_path('app/public/' . $fileName);
        $pdf->save($filePath);

        return redirect()->route('admin.records.records')
            ->with('success', 'Certificate generated successfully!')
            ->with('downloadUrl', asset('storage/' . $fileName));
    }

    public function generateBUSINESSPERMITCertificatePDF(Request $request, $id)
    {
        $request->validate([
            'status' => 'nullable|string|max:255',
        ]);

        $record = AdminRecords::findOrFail($id);

        $record->update([
            'status' => $request->input('status', 'accepted'),
        ]);

        $data = [
            'requirement' => $record->requirement,
            'address' => $record->address,
            'fullname' => $record->fullname,
            'day' => now()->format('jS'),
            'month' => now()->format('F'),
            'year' => now()->format('Y'),
        ];

        $pdf = Pdf::loadView('admin.records.BussinessPermitCertificate', $data)
            ->setPaper('a4', 'portrait')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);

        $fileName = 'Business_Permit_' . $record->fullname . '.pdf';
        $filePath = storage_path('app/public/' . $fileName);
        $pdf->save($filePath);

        return redirect()->route('admin.records.records')
            ->with('success', 'Certificate generated successfully!')
            ->with('downloadUrl', asset('storage/' . $fileName));
    }

    public function deletes($id): RedirectResponse
    {
        try {
            $records = AdminRecords::findOrFail($id);

            $archivedRecords = new AdminArchivedRecords();
            $archivedRecords->fullname = $records->fullname;
            $archivedRecords->age = $records->age;
            $archivedRecords->address = $records->address;
            $archivedRecords->purpose = $records->purpose;
            $archivedRecords->sender = $records->sender;
            $archivedRecords->requirement = $records->requirement;
            $archivedRecords->requesttype = $records->requesttype;
            $archivedRecords->status = 'received';
            $archivedRecords->response = $records->response;
            $archivedRecords->personIncharge = auth()->user()->email;
            $archivedRecords->remove_at = now();
            $archivedRecords->created_at = $records->created_at;
            $archivedRecords->personIncharge = auth()->user()->email;
            $archivedRecords->save();

            $records->delete();

            session()->flash('success', 'document has been received!');
        } catch (ModelNotFoundException $e) {
            session()->flash('error', ' response not found.');
        } catch (\Exception $e) {
            session()->flash('error', 'An unexpected error occurred: ' . $e->getMessage());
        }

        return redirect()->route('admin.records.records');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        try {

            $request->validate([
                'status' => 'required|in:rejected,Accepted',
                'response' => 'required',
            ]);

            $records = AdminRecords::findOrFail($id);

            $archivedRecords = new AdminArchivedRecords();
            $archivedRecords->fullname = $records->fullname;
            $archivedRecords->age = $records->age;
            $archivedRecords->address = $records->address;
            $archivedRecords->purpose = $records->purpose;
            $archivedRecords->sender = $records->sender;
            $archivedRecords->requirement = $records->requirement;
            $archivedRecords->requesttype = $records->requesttype;

            $status = $request->input('status', 'Rejected');
            $response = $request->input('response');

            $archivedRecords->status = $status;
            $archivedRecords->response = $response;

            $archivedRecords->remove_at = now();
            $archivedRecords->created_at = $records->created_at;
            $archivedRecords->personIncharge = auth()->user()->email;

            $archivedRecords->save();

            $records->delete();

            session()->flash('success', 'Your response was successfully submitted!');
        } catch (ModelNotFoundException $e) {
            session()->flash('error', ' response not found.');
        } catch (\Exception $e) {
            session()->flash('error', 'An unexpected error occurred: ' . $e->getMessage());
        }

        return redirect()->route('admin.records.records');
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

        return redirect()->route('admin.records.records')
            ->with('success', 'Document request updated successfully!');
    }

}
