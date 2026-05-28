<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SkpdController;
use App\Http\Controllers\PjSkpdController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\UserController;

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
        ->name('logout');

    Route::get('/skpd', [SkpdController::class, 'index'])
        ->name('skpd.index');

    Route::get('/skpd/create', [SkpdController::class, 'create'])
        ->name('skpd.create');
    
    Route::post('/skpd', [SkpdController::class, 'store'])
        ->name('skpd.store');

    Route::get('/skpd/{id}/edit', [SkpdController::class, 'edit'])
        ->name('skpd.edit');
    
    Route::put('/skpd/{id}', [SkpdController::class, 'update'])
        ->name('skpd.update');

    Route::delete('/skpd/{id}', [SkpdController::class, 'destroy'])
        ->name('skpd.destroy');

    Route::get('/pjskpd', [PjSkpdController::class, 'index'])
        ->name('pjskpd.index');

    Route::get('/pjskpd/create', [PjSkpdController::class, 'create'])
        ->name('pjskpd.create');

    Route::post('/pjskpd', [PjSkpdController::class, 'store'])
        ->name('pjskpd.store');

    Route::get('/pjskpd/{id}/edit', [PjSkpdController::class, 'edit'])
        ->name('pjskpd.edit');

    Route::put('/pjskpd/{id}', [PjSkpdController::class, 'update'])
        ->name('pjskpd.update');

    Route::delete('/pjskpd/{id}', [PjSkpdController::class, 'destroy'])
        ->name('pjskpd.destroy');
    
    Route::resource('monitoring', MonitoringController::class)->except(['show']);

    Route::resource('pengguna', UserController::class)->except(['show']);
});

// Redirect root
Route::redirect('/', '/login');