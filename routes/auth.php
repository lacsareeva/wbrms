<?php

use App\Http\Controllers\Resident\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Resident\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Resident\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Resident\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Resident\Auth\NewPasswordController;
use App\Http\Controllers\Resident\Auth\PasswordController;
use App\Http\Controllers\Resident\Auth\PasswordResetLinkController;
use App\Http\Controllers\Resident\Auth\RegisteredUserController;
use App\Http\Controllers\Resident\Auth\VerifyEmailController;
use App\Http\Controllers\Resident\ResidentDashboardController;
use App\Http\Controllers\Resident\ResidentBlotterController;
use App\Http\Controllers\Resident\ResidentBorrowedController;
use App\Http\Controllers\Resident\ResidentProfileController;
use App\Http\Controllers\Resident\ResidentRecordController;
use App\Http\Controllers\Resident\ResidentReportsController;
use App\Http\Controllers\Resident\ResidentBrgyOfficialsController;
use Illuminate\Support\Facades\Route;

Route::prefix('resident')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('resident.register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('resident.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('resident.store');

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'showForgotPasswordForm'])
        ->name('resident.forgot-password');

    Route::post('/send-otp', [PasswordResetLinkController::class, 'sendOtp'])
        ->name('resident.send-otp');

    Route::post('/verify-otp', [PasswordResetLinkController::class, 'verifyOtp'])
        ->name('resident.verify-otp');

    Route::get('/verify-otp', [PasswordResetLinkController::class, 'showVerifyOTPForm'])
        ->name('resident.verify-otp');

    Route::get('/reset-password/{email}', [PasswordResetLinkController::class, 'showResetPasswordForm'])
        ->name('resident.password.reset');

    Route::post('/reset-password', [PasswordResetLinkController::class, 'resetPassword'])
        ->name('resident.reset-password');
});

Route::prefix('resident')->middleware('auth:web')->group(function () {

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('resident.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('resident.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('resident.password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('resident.password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('resident.logout');

});

Route::prefix('resident')->middleware(['auth:web', 'check.user.role:web'])->group(function () {

    //dashboard
    Route::get('/dashboard', [ResidentDashboardController::class, 'index'])
        ->name('resident.dashboard');
    e('resident.dashboard');

    //resident-and-officials
    Route::get('/resident-and-officials', [ResidentBrgyOfficialsController::class, 'index'])
        ->name('resident.brgyOfficials.brgyOfficials');

    //profile
    Route::get('/profile', [ResidentProfileController::class, 'show'])
        ->name('resident.profile.profile');

    Route::put('/profile/update', [ResidentProfileController::class, 'update'])
        ->name('resident.profile.update');

    Route::put('/profile/updates', [ResidentProfileController::class, 'updatePassword'])
        ->name('resident.password.updates');

    //blotter
    Route::get('/blotter', [ResidentBlotterController::class, 'index'])
        ->name('resident.blotter.blotter');

    Route::post('/blotter/save', [ResidentBlotterController::class, 'save'])
        ->name('resident.blotter.save');

    Route::put('/blotter/update/{id}', [ResidentBlotterController::class, 'update'])
        ->name('resident.blotter.update');

    //borrowed
    Route::get('/borrowed', [ResidentBorrowedController::class, 'show'])
        ->name('resident.borrowed.borrowed');

    Route::post('/borrowed/save', [ResidentBorrowedController::class, 'save'])
        ->name('resident.borrowed.save');

    Route::put('/borrowed/update/{id}', [ResidentBorrowedController::class, 'update'])
        ->name('resident.borrowed.update');

    //report
    Route::get('/report', [ResidentReportsController::class, 'show'])
        ->name('resident.report.report');

    //record
    Route::get('/record', [ResidentRecordController::class, 'show'])
        ->name('resident.record.record');

    Route::put('/record/update/{id}', [ResidentRecordController::class, 'update'])
        ->name('resident.record.update');

    Route::post('/record/save', [ResidentRecordController::class, 'save'])
        ->name('resident.record.save');

});

