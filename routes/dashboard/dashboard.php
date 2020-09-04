<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Team\TeamDashboardController;

Route::get('/dashboard', DashboardController::class)->name('dashboard')->middleware('auth', 'verified');

Route::get('/dashboard/{team:slug}', TeamDashboardController::class)->middleware('auth', 'verified', 'userIsATeamMemberOrAdmin')->name('team.dashboard');

