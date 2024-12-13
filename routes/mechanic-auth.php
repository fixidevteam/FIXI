<?php

use App\Http\Controllers\Mechanic\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Mechanic\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\getAnalyticsDataController;
use App\Http\Controllers\Mechanic\ChartContoller;
use App\Http\Controllers\Mechanic\MechanicClientController;
use App\Http\Controllers\Mechanic\MechanicOperatioController;
use App\Http\Controllers\Mechanic\MechanicVoitureController;
use App\Http\Controllers\Mechanic\ProfileController;
use App\Http\Controllers\Mechanic\mechanicDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:mechanic')->prefix('fixi-pro')->name('mechanic.')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    // ->name('register');

    // Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware(['auth:mechanic', 'checkMechanicStatus'])->prefix('fixi-pro')->name('mechanic.')->group(function () {
    Route::get('/dashboard',[mechanicDashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // routes func :
    Route::resource('/operations', MechanicOperatioController::class);
    Route::resource('/voitures', MechanicVoitureController::class);
    Route::resource('/clients', MechanicClientController::class);
    Route::get('/analytics-data', [getAnalyticsDataController::class, 'getAnalyticsData'])->name('analytics.data');
    Route::get('/chart',[ChartContoller::class,'index'])->name('chart');

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});