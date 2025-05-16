<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\PickupRequestController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

Route::middleware([
    EnsureFrontendRequestsAreStateful::class,
    'api'
])->group(function () {
    // Register dan Login API
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->get('/auth/me', [AuthController::class, 'me']);

    // Protected Report API
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/report', [ReportController::class, 'store']);
    });
    Route::middleware('auth:sanctum')->post('/pickup-requests', [PickupRequestController::class, 'store']);
    Route::get('/users', [AuthController::class, 'index']); // Get All Users
    Route::get('/users/{id}', [AuthController::class, 'show']); // Get User By ID
    Route::put('/users/{id}', [AuthController::class, 'update']); // Update User
    Route::delete('/users/{id}', [AuthController::class, 'destroy']); // Delete User
    Route::patch('/users/{id}/status', [AuthController::class, 'changeStatus']); // Change Status
});
