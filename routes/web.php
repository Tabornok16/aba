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
use App\Http\Controllers\PointController;
use App\Http\Controllers\CityOfficialController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\PublicAdvisoryController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportCategoryController;
use App\Http\Controllers\NotificationController;
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

    // Resident Validation Routes
    Route::patch('/resident-validations/{validation}/validate', [StaffDashboardController::class, 'validate'])->name('resident-validations.validate');
    Route::patch('/resident-validations/{validation}/reject', [StaffDashboardController::class, 'reject'])->name('resident-validations.reject');

    // Redirect based on role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/temporary', [TemporaryDashboardController::class, 'index'])->name('temporary.dashboard');

    // Resident routes
    Route::resource('residents', ResidentController::class);
    Route::post('/residents/{resident}/validate', [ResidentController::class, 'validate_registration'])->name('residents.validate');

    // Points System Routes
    Route::get('/points', [PointController::class, 'index'])->name('points.index');
    Route::post('/points/redeem', [PointController::class, 'redeem'])->name('points.redeem');
    Route::get('/points/history', [PointController::class, 'history'])->name('points.history');
    Route::get('/points/leaderboard', [PointController::class, 'leaderboard'])->name('points.leaderboard');

    // City Officials Routes
    Route::resource('city-officials', CityOfficialController::class);

    // Rank System Routes
    Route::resource('ranks', RankController::class);

    // Leaderboard Routes
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
    Route::get('/leaderboard/overall', [LeaderboardController::class, 'overall'])->name('leaderboard.overall');
    Route::get('/leaderboard/monthly', [LeaderboardController::class, 'monthly'])->name('leaderboard.monthly');

    // Public Advisory Routes
    Route::resource('public-advisories', PublicAdvisoryController::class);

    // Badge Routes
    Route::resource('badges', BadgeController::class);

    // Report Routes
    Route::get('/reports/my-reports', [ReportController::class, 'myReports'])->name('reports.my-reports');
    Route::get('/reports/manage', [ReportController::class, 'manage'])->name('reports.manage');
    Route::post('/reports/{report}/verify', [ReportController::class, 'verify'])->name('reports.verify');
    Route::post('/reports/{report}/resolve', [ReportController::class, 'resolve'])->name('reports.resolve');
    Route::resource('reports', ReportController::class);
    Route::resource('report-categories', ReportCategoryController::class);

    // Notification Routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

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