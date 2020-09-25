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
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\LandingPageController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProfilePageController;
use App\Http\Controllers\Frontend\TeamPageController;
use App\Http\Controllers\Frontend\TermsForUsersPageController;

Route::domain('{team:slug}.' . basename(config('app.url')))->group(function () {

    Route::get('/', ProfilePageController::class)->name('profile-page');

    // quitar tambien la referencia a esta ruta en los temas y despues quitar esta ruta
    Route::get('/checkout/{amount}', CheckoutController::class)->name('checkout');

    Route::post('/pay/{plan}', PaymentController::class)->name('pay');

//    Route::get('/certificate/{}', CertificateController)->name('donation-certificate');
//
//    Route::post('/pay', 'Foundations\\PaymentController')->name('pay');
//
//    Route::get('/payment-congrats', 'Foundations\\PaymentCongratsController')->name('payment.congrats');

});

Route::get('/', LandingPageController::class)->name('welcome');

Route::get('/terminos-y-condiciones', TermsForUsersPageController::class)->name('terms-for-users');

Route::get('/quienes-somos', AboutUsPageController::class)->name('about-us');

Route::get('/fundaciones', TeamPageController::class)->name('teams-page');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::post('/newsletter', NewsletterController::class)->name('newsletter.store');
