<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\AdminAnnouncement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ResidentAnnouncementController extends Controller
{
    public function index(Request $request): View
    {
        $announcements = AdminAnnouncement::all();
        $announcements = AdminAnnouncement::orderBy('id', 'desc')->get();
        return view('resident.dashboard', compact('announcements'));
    }
}
