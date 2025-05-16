<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthWebController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// GET Route untuk tampilan halaman form
Route::get('/auth/register', fn() => view('pages.auth.auth-register'))->name('auth.register.form');
Route::get('/auth/login', fn() => view('pages.auth.auth-login'))->name('auth.login.form');


Route::post('/auth/register', [AuthWebController::class, 'register'])->name('web.auth.register');
Route::post('/auth/login', [AuthWebController::class, 'login'])->name('web.auth.login');
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');
