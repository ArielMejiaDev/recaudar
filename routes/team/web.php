<?php

use App\Http\Controllers\Team\DonationButton\DonationButtonController;
use App\Http\Controllers\Team\Plans\PlansController;
use App\Http\Controllers\Team\Profile\TeamProfileController;
use App\Http\Controllers\Team\Profile\UpdateTeamBannerController;
use App\Http\Controllers\Team\Profile\UpdateTeamLogoController;
use App\Http\Controllers\Team\Profile\UpdateTeamPromotionalVideoController;
use App\Http\Controllers\Team\Profile\UpdateTeamSocialNetworksController;
use App\Http\Controllers\Team\Profile\UpdateTeamThemeController;
use App\Http\Controllers\Team\TeamController;
use App\Http\Controllers\Team\TeamDashboardController;
use App\Http\Controllers\Team\Transaction\TransactionController;
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

// some file

Route::prefix('teams')->middleware(['auth', 'verified', 'userIsATeamMember'])->group(function() {

    Route::prefix('/{team:slug}')->group(function() {

        Route::get('/', TeamDashboardController::class)->name('teams.dashboard');

        Route::resource('users', UserController::class, ['as' => 'teams'])->except('show');

    });

});



// some file

Route::prefix('teams')->middleware(['auth', 'verified', 'userIsATeamMember'])->group(function() {

    Route::get('/{team:slug}/profile', TeamProfileController::class )->name('teams.profile');

    Route::put('/{team:slug}/profile/update-logo', UpdateTeamLogoController::class)
        ->name('teams.profile.update_logo');

    Route::put('/{team:slug}/profile/update-banner', UpdateTeamBannerController::class)
        ->name('teams.profile.update_banner');

    Route::put('/{team:slug}/profile/update-theme', UpdateTeamThemeController::class)
        ->name('teams.profile.update_theme');

    Route::put('/{team:slug}/profile/update-social-networks', UpdateTeamSocialNetworksController::class)
        ->name('teams.profile.update_social_networks');

    Route::put('/{team:slug}/profile/update-promotional-video', UpdateTeamPromotionalVideoController::class)
        ->name('teams.profile.update_promotional_video');

});


// some file

Route::prefix('teams')->middleware(['auth', 'verified', 'userIsATeamMember'])->group(function() {

    Route::prefix('/{team:slug}')->group(function() {

        Route::resource('plans', PlansController::class, ['as' => 'teams'])->except('show');

        Route::resource('transactions', TransactionController::class, ['as' => 'teams'])->only(['index', 'show']);

        Route::get('/donation-button', DonationButtonController::class)->name('teams.donation_button');

    });

});
