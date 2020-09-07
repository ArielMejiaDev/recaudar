<?php

use App\Http\Controllers\Team\TeamController;
use App\Http\Controllers\Team\TeamDashboardController;
use App\Http\Controllers\Team\User\UserController;


Route::prefix('teams')->middleware(['auth', 'verified'])->group(function() {

    Route::get('/create', [TeamController::class, 'create'])->name('teams.create');

    Route::middleware('userIsATeamMember')->group(function() {

        Route::get('/edit/{team:slug}', [TeamController::class, 'edit'])->name('teams.edit');

        Route::put('/update/{team:slug}', [TeamController::class, 'update'])->name('teams.update');

        Route::delete('/delete/{team:slug}', [TeamController::class, 'destroy'])->name('teams.delete');

    });

    Route::get('/', [TeamController::class, 'index'])->name('teams.index');

    Route::post('/store', [TeamController::class, 'store'])->name('teams.store');

});

Route::prefix('teams')->middleware(['auth', 'verified', 'userIsATeamMember'])->group(function() {

    Route::prefix('/{team:slug}')->group(function() {

        Route::get('/', TeamDashboardController::class)->name('teams.dashboard');

        Route::resource('users', UserController::class, ['as' => 'teams']);

    });

});

