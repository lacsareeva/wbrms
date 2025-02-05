<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Resident\Auth\AuthenticatedSessionController;
use App\Http\Middleware\CheckUserRole;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Resident\ResidentDashboardController;

Route::get('/', function () {
    return view('resident/auth/login');
});


Route::get('/unauthorized', function () {
    return response()->view('errors.unauthorized', [], 403);
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin-auth.php';
