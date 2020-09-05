<?php

use App\Http\Controllers\Team\TeamController;
use App\Http\Controllers\Team\TeamDashboardController;


Route::prefix('teams')->group(function() {

    Route::get('/create', [TeamController::class, 'create'])
        ->name('teams.create')
        ->middleware('auth', 'verified');

    Route::get('/edit/{team:slug}', [TeamController::class, 'edit'])
        ->name('teams.edit')
        ->middleware('auth', 'verified', 'userIsATeamMember');

    Route::put('/update/{team:slug}', [TeamController::class, 'update'])
        ->name('teams.update')
        ->middleware('auth', 'verified', 'userIsATeamMember');

    Route::delete('/delete/{team:slug}', [TeamController::class, 'destroy'])
        ->name('teams.delete')
        ->middleware('auth', 'verified', 'userIsATeamMember');





    Route::get('/{team:slug}', TeamDashboardController::class)
        ->middleware('auth', 'verified', 'userIsATeamMember')
        ->name('teams.dashboard');




    Route::get('/', [TeamController::class, 'index'])
        ->name('teams.index')
        ->middleware('auth', 'verified');

    Route::post('/store', [TeamController::class, 'store'])
        ->name('teams.store')
        ->middleware('auth', 'verified');

});
