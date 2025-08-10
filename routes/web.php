<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\OTPController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// OTP Verification Routes
Route::middleware('auth')->group(function () {
    Route::get('/verify/otp', [OTPController::class, 'showVerificationForm'])->name('verify.otp');
    Route::post('/verify/otp', [OTPController::class, 'verifyOTP']);
    Route::get('/otp/send', [OTPController::class, 'sendOTP'])->name('otp.send');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});