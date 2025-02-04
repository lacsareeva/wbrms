<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminAnnouncement;

use Symfony\Component\HttpFoundation\Response; // Correct import for the Response class

class ResidentDashboardController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::guard('web')->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized access: Only residents are allowed'], 401);
        }

        $announcements = AdminAnnouncement::all();
        $announcements = AdminAnnouncement::orderBy('id', 'desc')->get();
        return view('resident.dashboard', compact('announcements'));
   
    }
}
