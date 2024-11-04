<?php

use App\Http\Controllers\Mechanic\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Mechanic\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Mechanic\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:mechanic')->prefix('mechanic')->name('mechanic.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:mechanic')->prefix('mechanic')->name('mechanic.')->group(function () {
    Route::get('/dashboard', function () {
        return view('mechanic.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});