<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResidentAccountsController extends Controller
{
    public function verifyindex(Request $request): View
    {
        $users = User::where('verificationInfo', 'not verified')
            ->orderBy('id', 'desc')
            ->paginate(10); // Use paginate for proper pagination handling

        return view('admin.residentofficials.residentofficials', compact('users'));
    }
}
