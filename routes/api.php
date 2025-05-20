<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\PickupRequestController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

// ==============================
// Public Routes (No Auth Required)
// ==============================
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// ==============================
// Protected Routes (Auth Required)
// ==============================
Route::middleware(['auth:sanctum', EnsureFrontendRequestsAreStateful::class])->group(function () {

    // === User Authentication Info ===
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/profile-picture', [AuthController::class, 'updateProfilePicture']);

    // === Report Submission & Management ===
    Route::post('/report', [ReportController::class, 'store']);             // User submit report
    Route::get('/reports', [ReportController::class, 'index']);             // Admin: all reports, User: own reports
    Route::get('/reports/{id}', [ReportController::class, 'show']);         // Admin/User view report detail
    Route::delete('/reports/{id}', [ReportController::class, 'destroy']);   // Admin/User delete report

    // === Pickup Request (User) ===
    Route::post('/pickup-requests', [PickupRequestController::class, 'store']);
    Route::get('/pickup-requests/history', [PickupRequestController::class, 'history']);
    Route::get('/pickup-requests/history-by-date', [PickupRequestController::class, 'historyByDate']);

    // === Admin-Only Routes ===
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':admin'])->group(function () {

        // User Management
        Route::get('/users', [AuthController::class, 'index']);               // Get All Users
        Route::get('/users/{id}', [AuthController::class, 'show']);           // Get User By ID
        Route::put('/users/{id}', [AuthController::class, 'update']);         // Update User
        Route::delete('/users/{id}', [AuthController::class, 'destroy']);     // Delete User
        Route::patch('/users/{id}/status', [AuthController::class, 'changeStatus']); // Change User Status

        // Pickup Request Management (Admin)
        Route::get('/pickup-requests', [PickupRequestController::class, 'index']);                  // List All Pickup Requests
        Route::get('/pickup-requests/{id}', [PickupRequestController::class, 'show']);              // View Pickup Detail
        Route::patch('/pickup-requests/{id}/status', [PickupRequestController::class, 'updateStatus']); // Change Status
        Route::get('/pickup-requests/filter', [PickupRequestController::class, 'filterByStatus']);   // Filter by Status
        Route::get('/pickup-requests/search', [PickupRequestController::class, 'search']);          // Search by Name/Address

        // Report Management (Admin Only)
        // Report Management (Admin Only)
        Route::get('/reports/search', [ReportController::class, 'search']); // Tempatkan di atas
        Route::get('/reports/{id}', [ReportController::class, 'show']);     // Tempatkan di bawah

        // Admin search reports
        Route::patch('/reports/{id}/status', [ReportController::class, 'updateStatus']); // Admin change report status
    });
});
