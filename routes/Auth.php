
<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RestPasswordController;
use App\Http\Controllers\Auth\EmailVerificationController;

Route::middleware('guest')->group(function () {
    //_____________register auth
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    //_____________register login
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    //_____________reset password
    Route::get('/forgot-password', [RestPasswordController::class, 'requestpassword'])
        ->name('password.request');
    Route::post('/forgot-password', [RestPasswordController::class, 'sendEmail'])
        ->name('password.email');

    //----------------------rest passwordhandler
    Route::get('/reset-password/{token}', [RestPasswordController::class, 'resetForm'])
        ->name('password.reset');
    Route::post('/reset-password', [RestPasswordController::class, 'resethandlerpassword'])
        ->name('password.update');
});
Route::middleware('auth')->group(function () {
    Route::get('/change-password', [RestPasswordController::class, 'edit'])->name('password.change');
    Route::post('/change-password', [RestPasswordController::class, 'updateafterlogin'])->name('password.updateafterlogin');
});

Route::middleware('auth')->group(function () {
    //-------------logout-------//

    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');


    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
        ->name('verification.notice');

    //-------------email verivication-------//

    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'handler'])
        ->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware(['throttle:6,1'])->name('verification.send');
    //-------------password confirm-------//
});
