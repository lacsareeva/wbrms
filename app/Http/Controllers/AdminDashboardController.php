<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminBlotter;
use App\Models\AdminBorrowed;
use App\Models\AdminRecords;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response; // Correct import for the Response class
use Closure;
class AdminDashboardController extends Controller
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->usertype !== 'Admin') {
            abort(403, 'Unauthorized access'); // Block access
        }
        return $next($request);
    }

    public function index(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::guard('admin')->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $data = [
            'name' => $user->name,
        ];

        $borrowed = AdminBorrowed::all();
        $borrowed = AdminBorrowed::orderBy('id', 'desc')->get();

        $blotter = AdminBlotter::all();
        $blotter = AdminBlotter::orderBy('id', 'desc')->get();

        $records = AdminRecords::all();
        $records = AdminRecords::orderBy('id', 'desc')->get();

        $users = User::all();
        $users = User::orderBy('id', 'desc')->get();


        return view('admin.dashboard', $data, compact('blotter', 'borrowed', 'records', 'users'));
    }
}

