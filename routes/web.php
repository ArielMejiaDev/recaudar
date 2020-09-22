<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Frontend\AboutUsPageController;
use App\Http\Controllers\Frontend\LandingPageController;
use App\Http\Controllers\Frontend\ProfilePageController;
use App\Http\Controllers\Frontend\TeamPageController;
use App\Http\Controllers\Frontend\TermsForUsersPageController;

Route::domain('{team:slug}.' . basename(config('app.url')))->group(function () {

    Route::get('/', ProfilePageController::class)->name('profile-page');

//    Route::get('/', 'Foundations\\HomepageController')->name('foundations.homepage')->middleware('approvedFoundation');

//    Route::get('/checkout/{amount}', 'Foundations\\CheckoutController')->name('checkout');
//
//    Route::post('/pay', 'Foundations\\PaymentController')->name('pay');
//
//    Route::get('/payment-congrats', 'Foundations\\PaymentCongratsController')->name('payment.congrats');

});

Route::get('/', LandingPageController::class)->name('welcome');

Route::get('/terminos-y-condiciones', TermsForUsersPageController::class)->name('terms-for-users');

Route::get('/quienes-somos', AboutUsPageController::class)->name('about-us');

Route::get('/fundaciones', TeamPageController::class)->name('teams-page');
