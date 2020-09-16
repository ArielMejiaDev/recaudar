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
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Teams\TeamController;
use App\Http\Controllers\Admin\Transactions\TransactionsController;

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/', DashboardController::class)->name('admin.dashboard');

    Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');

    Route::post('/admins/store', [AdminController::class, 'store'])->name('admin.admins.store');

    Route::resource('teams', TeamController::class, ['as' => 'admin']);

    Route::resource('transactions', TransactionsController::class, ['as' => 'admin']);

});
