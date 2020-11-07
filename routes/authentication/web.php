<?php

/*
|--------------------------------------------------------------------------
| Auth Web Routes
|--------------------------------------------------------------------------
|
| Here is where all authentication feature routes are placed
|
*/

Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => 'throttle:300,10'], function() {

    Auth::routes(['verify' => true]);

});
