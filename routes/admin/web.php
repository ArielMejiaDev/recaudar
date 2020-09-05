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
Route::inertia('/admin', 'AdminDashboard/Index')
    ->name('admin.dashboard')->middleware('auth', 'verified');
