<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChurchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TeamsController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Route::permanentRedirect('/', '/dashboard');

Route::get('/panel/login', [AuthController::class, 'login'])->name('login');
Route::post('/panel/login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::get('/panel/register', [AuthController::class, 'register'])->name('register');
Route::post('/panel/register', [AuthController::class, 'createAccount'])->name('createAccount');

Route::middleware(['auth', 'web'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('churches')->group(function () {
            Route::get('/create', [ChurchController::class, 'show'])->name('churches.create');
            Route::post('/create', [ChurchController::class, 'store'])->name('churches.store');
        });

        Route::prefix('settings')->group(function () {
            Route::get('/{user}', [SettingsController::class, 'index'])->name('settings');
        });

        Route::prefix('teams')->group(function () {
            Route::get('/create', [TeamsController::class, 'create'])->name('teams.create')->middleware('teams');
            Route::post('/create', [TeamsController::class, 'store'])->name('teams.store')->middleware('teams');

            Route::post('/team-switch/{team}', [TeamsController::class, 'switchTeam'])->name('teams.switch');
            Route::get('/{currentTeam}', [TeamsController::class, 'show'])->name('teams.show');
        });
    });

    Route::post('/panel/logout', [AuthController::class, 'logout'])->name('logout');
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/custom/livewire/update', $handle)
        ->middleware(['auth', 'web']);
});
