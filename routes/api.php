<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\PickupRequestController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

// Public Routes (No Auth)
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Protected Routes
Route::middleware(['auth:sanctum', EnsureFrontendRequestsAreStateful::class])->group(function () {

    // Auth Info
    Route::get('/auth/me', [AuthController::class, 'me']);

    // Report Submission (User)
    Route::post('/report', [ReportController::class, 'store']);

    // Pickup Request Submission (User)
    Route::post('/pickup-requests', [PickupRequestController::class, 'store']);

    // User Management (Admin Only)
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':admin'])->group(function () {
        Route::get('/users', [AuthController::class, 'index']);             // Get All Users
        Route::get('/users/{id}', [AuthController::class, 'show']);         // Get User By ID
        Route::put('/users/{id}', [AuthController::class, 'update']);       // Update User
        Route::delete('/users/{id}', [AuthController::class, 'destroy']);   // Delete User
        Route::patch('/users/{id}/status', [AuthController::class, 'changeStatus']); // Change Status
    });

});
