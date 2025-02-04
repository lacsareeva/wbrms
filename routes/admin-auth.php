<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\AdminAnnouncmentController;
use App\Http\Controllers\AdminReportsController;
use App\Http\Controllers\AdminBlotterController;
use App\Http\Controllers\AdminBorrowedController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminRecordsController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Middleware\CheckUserRole;

use App\Http\Controllers\ResidentAccountsController;


use App\Http\Controllers\BarangayOfficialsController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
 
    Route::get('login', [LoginController::class, 'create'])
        ->name('admin.login');

    Route::post('login', [LoginController::class, 'store']);

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'showForgotPasswordForm'])
        ->name('admin.forgot-password');

    Route::post('/send-otp', [PasswordResetLinkController::class, 'sendOtp'])
        ->name('admin.send-otp');

    Route::post('/verify-otp', [PasswordResetLinkController::class, 'verifyOtp'])
        ->name('admin.verify-otp');

    Route::get('/verify-otp', [PasswordResetLinkController::class, 'showVerifyOTPForm'])
        ->name('admin.verify-otp');

    Route::get('/reset-password/{email}', [PasswordResetLinkController::class, 'showResetPasswordForm'])
        ->name('admin.password.reset');

    Route::post('/reset-password', [PasswordResetLinkController::class, 'resetPassword'])
        ->name('admin.reset-password');
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('admin.verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('admin.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('admin.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('admin.password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('admin.password.update');
    //logout

    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('admin.logout');

});

Route::prefix('admin')->middleware(['auth:admin', 'check.user.role:admin'])->group(function () {

    //dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // profile
    Route::get('/profile', function () {
        return view('admin.profile.editProfile');
    })->name('admin.profile.editProfile');

    Route::put('/profile/update', [AdminProfileController::class, 'update'])
        ->name('admin.profile.update');

    Route::put('/profile/updates', [AdminProfileController::class, 'updatePassword'])
        ->name('admin.password.updates');
    //list-of-accounts

    Route::get('/list-of-accounts', [RegisteredUserController::class, 'index'])
        ->name('admin.accounts.accounts');
    e('admin.accounts.accounts');

    Route::put('/accounts/update/{id}', [RegisteredUserController::class, 'update'])
        ->name('admin.accounts.update');

    Route::post('/accounts/save', [RegisteredUserController::class, 'save'])
        ->name('admin.accounts.save');

    Route::get('/accounts/delete/{id}', [RegisteredUserController::class, 'delete'])
        ->name('admin.accounts.delete');

    //Announcement
    Route::get('/announcement', [AdminAnnouncmentController::class, 'index'])
        ->name('admin.announcement.announcement');
    e('admin.announcement.announcement');

    Route::post('/announcement/save', [AdminAnnouncmentController::class, 'save'])
        ->name('admin.announcement.save');

    Route::put('/announcement/update/{id}', [AdminAnnouncmentController::class, 'update'])
        ->name('admin.announcement.update');

    Route::get('/announcement/delete/{id}', [AdminAnnouncmentController::class, 'delete'])
        ->name('admin.announcement.delete');

    //borrowed
    Route::get('/borrowed', [AdminBorrowedController::class, 'index'])
        ->name('admin.borrowed.borrowed');
    e('admin.borrowed.borrowed');

    Route::post('/borrowed/save', [AdminBorrowedController::class, 'save'])
        ->name('admin.borrowed.save');

    Route::put('/borrowed/updates/{id}', [AdminBorrowedController::class, 'updates'])
        ->name('admin.borrowed.updates');

    Route::put('/borrowed/update/{id}', [AdminBorrowedController::class, 'update'])
        ->name('admin.borrowed.update');

    Route::delete('/borrowed/delete/{id}', [AdminBorrowedController::class, 'delete'])
        ->name('admin.borrowed.delete');

    Route::get('/borrowed/deletes/{id}', [AdminBorrowedController::class, 'deletes'])
        ->name('admin.borrowed.deletes');

    //blotter
    Route::get('/blotter', [AdminBlotterController::class, 'index'])
        ->name('admin.blotter.blotter');
    e('admin.blotter.blotter');

    Route::post('/blotter/save', [AdminBlotterController::class, 'save'])
        ->name('admin.blotter.save');

    Route::put('/blotter/update/{id}', [AdminBlotterController::class, 'update'])
        ->name('admin.blotter.update');

    Route::delete('/blotter/delete/{id}', [AdminBlotterController::class, 'delete'])
        ->name('admin.blotter.delete');

    //records
    Route::get('/records', [AdminRecordsController::class, 'index'])
        ->name('admin.records.records');

    Route::post('/records/save', [AdminRecordsController::class, 'save'])
        ->name('admin.records.save');

    Route::get('/records/IndigencyCertificate/{id}', [AdminRecordsController::class, 'generateCertificatePDF'])
        ->name('generate.certificate');

    Route::get('/records/ResidencyCertificate/{id}', [AdminRecordsController::class, 'generateCertificateRESIDENCYPDF'])
        ->name('generate.certificate');

    Route::get('/records/BussinessPermitCertificate/{id}', [AdminRecordsController::class, 'generateBUSINESSPERMITCertificatePDF'])
        ->name('generate.certificate');

    Route::get('/records/deletes/{id}', [AdminRecordsController::class, 'deletes'])
        ->name('admin.records.deletes');

    Route::post('/records/delete/{id}', [AdminRecordsController::class, 'delete'])
        ->name('admin.records.delete');

    Route::put('/records/update/{id}', [AdminRecordsController::class, 'update'])
        ->name('admin.records.update');

    //reports
    Route::get('/reports', [AdminReportsController::class, 'index'])
        ->name('admin.reports.reports');

    //resident-and-officials
    Route::get('/resident-and-officials', [BarangayOfficialsController::class, 'index'])
        ->name('admin.residentofficials.residentofficials');


    Route::put('/resident-and-officials/{id}', [BarangayOfficialsController::class, 'update'])
        ->name('admin.residentofficials.update');

    Route::post('/resident-and-officials/verify/{email}', [BarangayOfficialsController::class, 'sendVerifyEmail'])
        ->name('admin.residentofficials.verify');

    Route::post('/resident-and-officials/reject/{email}', [BarangayOfficialsController::class, 'sendRejectEmail'])
        ->name('admin.residentofficials.reject');

    Route::get('/resident-and-officials/deletes/{id}', [BarangayOfficialsController::class, 'deletes'])
        ->name('admin.resident.deletes');

});
