<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('welcome'))->name('home');

// Alihkan /login ke form login yang sebenarnya
Route::get('/login', fn() => redirect()->route('auth.login.form'))->name('login');

// Auth Routes
Route::get('/auth/register', fn() => view('pages.auth.auth-register'))->name('auth.register.form');
Route::get('/auth/login', fn() => view('pages.auth.auth-login'))->name('auth.login.form');
Route::post('/auth/register', [AuthWebController::class, 'register'])->name('web.auth.register');
Route::post('/auth/login', [AuthWebController::class, 'login'])->name('web.auth.login');
Route::post('/logout', [AuthWebController::class, 'logout'])->name('logout');

// Admin Routes (dengan middleware auth + admin)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', fn() => view('pages.admin.dashboard'))->name('dashboard');
    // Tambahkan route admin lainnya di sini
});

// User Routes (dengan middleware auth)
Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'getDashboardData'])->name('dashboard');

    // Pickup Requests
    Route::get('/pickup/form', fn() => view('pages.user.pickup-form'))->name('pickup.form');
    Route::post('/pickup/store', [DashboardController::class, 'storePickupRequest'])->name('pickup.store');
    Route::get('/pickup/requests', [DashboardController::class, 'getPickupRequests'])->name('pickup.requests');

    // Reports
    Route::get('/report/form', fn() => view('pages.user.report-form'))->name('report.form');
    Route::post('/report/store', [DashboardController::class, 'storeReport'])->name('report.store');
    Route::get('/reports', [DashboardController::class, 'getReports'])->name('reports');

    // Maps & History
    Route::get('/map', fn() => view('pages.user.map'))->name('map');
    Route::get('/history', [DashboardController::class, 'getHistory'])->name('history');

    // Waste Sales
    Route::get('/waste/sell', [DashboardController::class, 'sellWasteForm'])->name('waste.sell.form');
    Route::post('/waste/sell/store', [DashboardController::class, 'storeWasteSale'])->name('waste.sell.store');
});

// Redirect /dashboard sesuai role
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware('auth')->name('dashboard');
