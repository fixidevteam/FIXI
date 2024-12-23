<?php

use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\generateVehicleHistoryPDF;
use App\Http\Controllers\getQuartiersController;
use App\Http\Controllers\getAnalyticsDataController;
use App\Http\Controllers\ListingGaragesController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\PapierPeronnelController;
use App\Http\Controllers\PapierVoitureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\VoitureController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// auth google 
Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);
Route::get('/my-fixi/complete-profile', [ProviderController::class, 'showCompleteProfileForm'])->name('complete-profile');
Route::post('/my-fixi/complete-profile', [ProviderController::class, 'completeProfile'])->name('complete-profile.post');

Route::get('/quartiers', [getQuartiersController::class, 'getQuartiers'])->name('quartiers.get');


Route::get('/dashboard', [dashboardController::class, 'index'])->middleware(['auth', 'verified', 'checkdocuments', 'checkUserStatus'])->prefix('my-fixi')->name('dashboard');

Route::middleware(['auth', 'checkdocuments', 'checkUserStatus'])->prefix('my-fixi')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/voiture', VoitureController::class);
    Route::resource('/paiperPersonnel', PapierPeronnelController::class);
    Route::resource('/paiperVoiture', PapierVoitureController::class);
    Route::resource('/operation', OperationController::class);
    Route::resource('/garages', ListingGaragesController::class);
    Route::resource('/promotions', PromotionController::class);
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::get('/voiture/{id}/pdf', [generateVehicleHistoryPDF::class, 'generateVehicleHistoryPDF'])->name('voiture.pdf');
});
// General Authentication Routes
require_once __DIR__ . '/auth.php';

// Admin-Specific Authentication Routes
require_once __DIR__ . '/admin-auth.php';

// Mechanic-Specific Authentication Routes
require_once __DIR__ . '/mechanic-auth.php';