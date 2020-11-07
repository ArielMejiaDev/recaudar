<?php

/*
|--------------------------------------------------------------------------
| Auth Web Routes
|--------------------------------------------------------------------------
|
| Here is where all authentication feature routes are placed
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function() {

    Auth::routes(['verify' => true]);

});
