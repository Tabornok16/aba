<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\OTPController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ManagerDashboardController;
use App\Http\Controllers\SupervisorDashboardController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\TemporaryDashboardController;
use App\Http\Controllers\ResidentController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// OTP Verification Routes
Route::middleware('auth')->group(function () {
    Route::get('/verify/otp', [OTPController::class, 'showVerificationForm'])->name('verify.otp');
    Route::post('/verify/otp', [OTPController::class, 'verifyOTP']);
    Route::get('/otp/send', [OTPController::class, 'sendOTP'])->name('otp.send');
    // Role-specific dashboards
    Route::get('/dashboard/admin', [AdminDashboardController::class, 'index'])->name('dashboard.admin');
    Route::post('/admin/managers/{user}/approve', [AdminDashboardController::class, 'approve'])->name('admin.managers.approve');
    Route::post('/admin/managers/{user}/reject', [AdminDashboardController::class, 'reject'])->name('admin.managers.reject');
    
    Route::get('/dashboard/manager', [ManagerDashboardController::class, 'index'])->name('dashboard.manager');
    Route::get('/dashboard/supervisor', [SupervisorDashboardController::class, 'index'])->name('dashboard.supervisor');
    Route::get('/dashboard/staff', [StaffDashboardController::class, 'index'])->name('dashboard.staff');

    // User approval routes
    Route::post('/users/{user}/approve', [ManagerDashboardController::class, 'approve'])->name('users.approve');
    Route::post('/users/{user}/reject', [ManagerDashboardController::class, 'reject'])->name('users.reject');
    Route::post('/residents/{user}/approve', [StaffDashboardController::class, 'approve'])->name('residents.approve');
    Route::post('/residents/{user}/reject', [StaffDashboardController::class, 'reject'])->name('residents.reject');
    Route::post('/users/{user}/verify-voter', [StaffDashboardController::class, 'verifyVoter'])->name('users.verify-voter');

    // Redirect based on role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/temporary', [TemporaryDashboardController::class, 'index'])->name('temporary.dashboard');

    // Resident routes
    Route::resource('residents', ResidentController::class);
    Route::post('/residents/{resident}/validate', [ResidentController::class, 'validate_registration'])->name('residents.validate');

    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update');