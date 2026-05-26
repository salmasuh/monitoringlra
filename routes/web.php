<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Login
Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthController::class, 'authenticate'])
    ->name('authenticate');

// Route setelah login
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard'])
        ->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout'); // tambahkan ini
});

// Redirect root
Route::redirect('/', '/login');