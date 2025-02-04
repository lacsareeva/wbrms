<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;

use App\Models\officialsinfo;
use Illuminate\Http\Request;
use Illuminate\View\View;
class ResidentBrgyOfficialsController extends Controller
{
    public function index(Request $request): View
    {
        $officialsinfo = OfficialsInfo::all(); // Fetch all officials
        return view('resident.brgyOfficials.brgyOfficials', compact('officialsinfo'));
    }

}
