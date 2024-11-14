<?php

use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\PapierPeronnelController;
use App\Http\Controllers\PapierVoitureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoitureController;
use App\Models\nom_categorie;
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'checkdocuments','checkUserStatus'])->name('dashboard');

Route::middleware(['auth', 'checkdocuments','checkUserStatus'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/voiture', VoitureController::class);
    Route::resource('/paiperPersonnel', PapierPeronnelController::class);
    Route::resource('/paiperVoiture', PapierVoitureController::class);
    Route::resource('/operation', OperationController::class);
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

});
Route::get('/api/operations/{categorieId}', [App\Http\Controllers\DataController::class, 'getOperations']);
Route::get('/api/sous-operations/{operationId}', [App\Http\Controllers\DataController::class, 'getSousOperations']);
require __DIR__ . '/auth.php';
require __DIR__ . '/admin-auth.php';
require __DIR__ . '/mechanic-auth.php';