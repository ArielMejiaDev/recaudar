<?php

/*
|--------------------------------------------------------------------------
| Profile Web Routes
|--------------------------------------------------------------------------
|
| Here all routes to manage users profile
|
*/

// this route is just for admin purpouse
use App\Http\Controllers\Admin\Admins\AdminController;
use App\Http\Controllers\Admin\Charges\ChargeController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Teams\Plans\PlanController;
use App\Http\Controllers\Admin\Teams\TeamController;
use App\Http\Controllers\Admin\Teams\UpdateTeamContact;
use App\Http\Controllers\Admin\Teams\UpdateTeamFinancialData;
use App\Http\Controllers\Admin\Teams\UpdateTeamMediaController;
use App\Http\Controllers\Admin\Teams\UpdateTeamProfile;
use App\Http\Controllers\Admin\Teams\UpdateTeamStatus;
use App\Http\Controllers\Admin\Transactions\TransactionsController;

Route::prefix('admin')->middleware(['auth', 'verified', 'appAdmin'])->group(function () {

    Route::get('/', DashboardController::class)->name('admin.dashboard');

    Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');

    Route::post('/admins/store', [AdminController::class, 'store'])->name('admin.admins.store');

    Route::resource('teams', TeamController::class, ['as' => 'admin'])->only(['index', 'edit', 'destroy']);

    Route::put('/teams/update-status/{team}', UpdateTeamStatus::class)->name('admin.teams.update-status');

    Route::put('/teams/update-profile/{team}', UpdateTeamProfile::class)->name('admin.teams.update-profile');

    Route::put('/teams/update-media/{team}', UpdateTeamMediaController::class)->name('admin.teams.update-media');

    Route::put('/teams/update-contact/{team}', UpdateTeamContact::class)->name('admin.teams.update-contact');

    Route::put('/teams/update-legal-data/{team}', UpdateTeamFinancialData::class)->name('admin.teams.update-legal-data');

    Route::get('/teams/{team}/plans', [PlanController::class, 'index'])->name('admin.teams.plans.index');

    Route::get('/teams/{team}/plans/{plan}/edit', [PlanController::class, 'edit'])->name('admin.teams.plans.edit');

    Route::put('/teams/{team}/plans/{plan}/update', [PlanController::class, 'update'])->name('admin.teams.plans.update');

    Route::resource('charges', ChargeController::class, ['as' => 'admin'])->except(['edit', 'update']);

    Route::resource('transactions', TransactionsController::class, ['as' => 'admin'])->only(['index', 'show', 'update']);

});
