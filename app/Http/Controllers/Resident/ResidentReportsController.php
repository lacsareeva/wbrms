<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminArchiveFile\AdminArchiveBorrowed;
use App\Models\AdminArchiveFile\AdminArchivedBlotter;
use App\Models\AdminArchiveFile\AdminArchivedRecords;

class ResidentReportsController extends Controller
{
    public function show(): View
    {

        if (!Auth::check()) {
            abort(403, 'Unauthorized access');
        }

        $archivedBlotter = AdminArchivedBlotter::where('sender', Auth::user()->email)->orderBy('id', 'desc')->get();

        $archivedBorrowed = AdminArchiveBorrowed::where('sender', Auth::user()->email)->orderBy('id', 'desc')->get();

        $archivedRecords = AdminArchivedRecords::where('sender', Auth::user()->email)->orderBy('id', 'desc')->get();

        return view('resident.report.report', compact('archivedBlotter', 'archivedBorrowed', 'archivedRecords'));

    }
}
