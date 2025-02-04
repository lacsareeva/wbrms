<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminArchiveFile\AdminArchiveAnnouncement;
use App\Models\AdminArchiveFile\AdminArchiveAccounts;
use App\Models\AdminBlotter;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
class AdminReportsController extends Controller
{

    public function index(Request $request): View
    {
        // Fetch archived announcements and blotters
        $archivedAnnouncements = AdminArchiveAnnouncement::orderBy('id', 'desc')->get();

        $blotter = DB::table('blotter')
            ->select('incident_report', 'nameofcomplainant', 'created_at', DB::raw('NULL as settled_at'));

        $archivedBlotter = DB::table('archivedBlotter')
            ->select('incident_report', 'nameofcomplainant', 'created_at', 'settled_at')
            ->union($blotter)
            ->orderBy('created_at', 'desc')
            ->get();


        $borrowed = DB::table('borrowed')
            ->select('name', 'equipment', 'created_at', 'return-date', 'status', DB::raw('NULL as settled_at'));

        $archivedBorrowed = DB::table('archivedBorrowed')
            ->select('name', 'equipment', 'created_at', 'return-date', 'status', 'returned_at')
            ->union($borrowed)
            ->orderBy('returned_at', 'Asc')
            ->get();

        $admins = DB::table('admins')
            ->select('name', 'mname', 'lname', 'suffix', 'usertype', 'created_at', DB::raw('NULL as remove_at'));

        $archivedAccounts = DB::table('archivedAccounts')
            ->select('name', 'mname', 'lname', 'suffix', 'usertype', 'created_at', 'remove_at')
            ->union($admins)
            ->orderBy('remove_at', 'Asc')
            ->get();

        $records = DB::table('records')
            ->select('fullname', 'created_at', 'requesttype', 'status', DB::raw('NULL as remove_at'));

        $archivedRecords = DB::table('archivedRecords')
            ->select('fullname', 'created_at', 'requesttype', 'status', 'remove_at')
            ->union($records)
            ->orderBy('remove_at', 'asc')
            ->get();

        return view('admin.reports.reports', compact('archivedAnnouncements', 'archivedBlotter', 'blotter', 'borrowed', 'archivedBorrowed', 'archivedAccounts', 'admins','records','archivedRecords'));
    }

}
