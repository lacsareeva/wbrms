<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\AdminArchiveFile\userArchiveAccounts;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\officialsinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class BarangayOfficialsController extends Controller
{
    public function index(Request $request): View
    {
        $officialsinfo = OfficialsInfo::get();

        $users = User::where('verificationInfo', 'not verified')
            ->orderBy('id', 'desc')
            ->get();

        $usersVerified = User::where('verificationInfo', 'verified')
            ->orderBy('id', 'desc')
            ->get();

        $usersRejected = userArchiveAccounts::where('verificationInfo', 'rejected')
            ->orderBy('id', 'desc')
            ->get();

        $usersRemove = userArchiveAccounts::where('verificationInfo', 'removed')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.residentofficials.residentofficials', compact('officialsinfo', 'users', 'usersVerified', 'usersRejected','usersRemove'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'officialsimage' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif|max:2048', // Optional image validation
        ]);

        $official = OfficialsInfo::findOrFail($id);

        // Update the fields
        $official->fullname = $request->fullname;
        $official->position = $request->position;

        // Handle image upload if provided
        if ($request->hasFile('officialsimage')) {
            $imagePath = $request->file('officialsimage')->store('officials_images', 'public');
            $official->officialsimage = $imagePath;
        }

        $official->save();

        return redirect()->back()->with('success', 'Official updated successfully.');
    }

    public function sendVerifyEmail(Request $request, $email)
    {
        $request->validate(['email' => 'required|email']);

        $userRequest = User::where('email', $email)->firstOrFail();

        $userRequest->update(['verificationInfo' => 'verified']);

        Mail::to($userRequest->email)->send(new VerifyEmail($userRequest, 'verified'));

        return redirect()->route('admin.residentofficials.residentofficials')
            ->with('message', 'Resident has been successfully verified.');
    }
    public function sendRejectEmail(Request $request, $email)
    {
        $request->validate([
            'email' => 'required|email',
            'response' => 'required|string|max:1000', // Validate the response field
        ]);

        // Fetch the user
        $userRequest = User::where('email', $email)->firstOrFail();

        // Begin transaction for safety
        DB::beginTransaction();

        try {
            // Archive the user's account
            $archivedAccounts = new UserArchiveAccounts();
            $archivedAccounts->name = $userRequest->name;
            $archivedAccounts->mname = $userRequest->mname;
            $archivedAccounts->lname = $userRequest->lname;
            $archivedAccounts->suffix = $userRequest->suffix;
            $archivedAccounts->email = $userRequest->email;
            $archivedAccounts->email_verified_at = $userRequest->email_verified_at;
            $archivedAccounts->password = $userRequest->password;
            $archivedAccounts->address = $userRequest->address;
            $archivedAccounts->usertype = $userRequest->usertype;
            $archivedAccounts->month = $userRequest->month;
            $archivedAccounts->day = $userRequest->day;
            $archivedAccounts->year = $userRequest->year;
            $archivedAccounts->gender = $userRequest->gender;
            $archivedAccounts->residenttype = $userRequest->residenttype;
            $archivedAccounts->age = $userRequest->age;
            $archivedAccounts->verificationInfo = 'rejected'; // Explicitly set the status
            $archivedAccounts->verification_id = $userRequest->verification_id;
            $archivedAccounts->verification_id_number = $userRequest->verification_id_number;
            $archivedAccounts->verification_id_image = $userRequest->verification_id_image;
            $archivedAccounts->response = $request->response; // Use the rejection reason from the request
            $archivedAccounts->personIncharge = auth()->user()->email ?? 'System';
            $archivedAccounts->created_at = $userRequest->created_at;
            $archivedAccounts->updated_at = now();
            $archivedAccounts->save();

            // Send rejection email
            $rejectionReason = $request->response;
            Mail::to($userRequest->email)->send(new VerifyEmail($userRequest, 'rejected', $rejectionReason));

            // Delete the user account
            $userRequest->delete();

            // Commit the transaction
            DB::commit();

            return redirect()->route('admin.residentofficials.residentofficials')
                ->with('message', 'Resident has been successfully rejected.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'An error occurred while rejecting the resident: ' . $e->getMessage());
        }
    }

    public function deletes($id): RedirectResponse
    {
        try {

            $archiveRequest = User::findOrFail($id);

            $archivedAccounts = new UserArchiveAccounts();
            $archivedAccounts->name = $archiveRequest->name;
            $archivedAccounts->mname = $archiveRequest->mname;
            $archivedAccounts->lname = $archiveRequest->lname;
            $archivedAccounts->suffix = $archiveRequest->suffix;
            $archivedAccounts->email = $archiveRequest->email;
            $archivedAccounts->email_verified_at = $archiveRequest->email_verified_at;
            $archivedAccounts->password = $archiveRequest->password;
            $archivedAccounts->address = $archiveRequest->address;
            $archivedAccounts->usertype = $archiveRequest->usertype;
            $archivedAccounts->month = $archiveRequest->month;
            $archivedAccounts->day = $archiveRequest->day;
            $archivedAccounts->year = $archiveRequest->year;
            $archivedAccounts->gender = $archiveRequest->gender;
            $archivedAccounts->residenttype = $archiveRequest->residenttype;
            $archivedAccounts->age = $archiveRequest->age;
            $archivedAccounts->verificationInfo = 'removed'; // Explicitly set the status
            $archivedAccounts->verification_id = $archiveRequest->verification_id;
            $archivedAccounts->verification_id_number = $archiveRequest->verification_id_number;
            $archivedAccounts->verification_id_image = $archiveRequest->verification_id_image;
           
            $archivedAccounts->personIncharge = auth()->user()->email ?? 'System';
            $archivedAccounts->created_at = $archiveRequest->created_at;
            $archivedAccounts->updated_at = now();
            $archivedAccounts->save();


            $archiveRequest->delete();

            session()->flash('message', 'Residents successfully removed!');
        }  catch (\Exception $e) {
            session()->flash('error', 'An unexpected error occurred: ' . $e->getMessage());
        }

        return redirect()->route('admin.residentofficials.residentofficials');
    }

}
