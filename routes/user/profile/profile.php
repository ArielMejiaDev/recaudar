<?php

/*
|--------------------------------------------------------------------------
| Profile Web Routes
|--------------------------------------------------------------------------
|
| Here all routes to manage users profile
|
*/

use App\Http\Controllers\User\Profile\ProfileUpdateAvatarController;
use App\Http\Controllers\User\Profile\ProfileUpdateCredentialsController;
use App\Http\Controllers\User\Profile\ProfileUpdatePasswordController;
use App\Http\Controllers\User\Profile\ShowProfileFormsController;
use Illuminate\Support\Facades\Route;

// TODOS
// Refactorizar el codigo actual en cada controller
    // Crear tests para cada escenario

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/profile', ShowProfileFormsController::class)->name('profile.show');
    Route::put('/profile/update-credentials', ProfileUpdateCredentialsController::class)->name('profile.update-credentials');
    Route::put('/profile/update-password', ProfileUpdatePasswordController::class)->name('profile.update-password');
    Route::put('/profile/update-avatar', ProfileUpdateAvatarController::class)->name('profile.update-avatar');
});
