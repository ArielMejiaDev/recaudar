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
use App\Http\Controllers\Frontend\AddContactFromProfilePageController;
use App\Http\Controllers\Frontend\CertificateController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\DonateDirectLinkController;
use App\Http\Controllers\Frontend\DonationButtonMarkupController;
use App\Http\Controllers\Frontend\LandingPageController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\NotAllowedActionController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProfilePageController;
use App\Http\Controllers\Frontend\TeamPageController;
use App\Http\Controllers\Frontend\TermsForTeamsPageController;
use App\Http\Controllers\Frontend\TermsForUsersPageController;

Route::domain('{team:slug}.' . basename(config('app.url')))->group(function () {

    Route::get('/', ProfilePageController::class)->name('profile-page');

    Route::post('/agregar-contacto', AddContactFromProfilePageController::class)->name('add_contact_from_profile_page');

    Route::get('/donar/{amount?}', DonateDirectLinkController::class)->name('donate-direct-link');

    Route::post('/pay/{plan}', PaymentController::class)->name('pay')->middleware('throttle:30,10');

    Route::get('/certificado/{transaction}', CertificateController::class)->name('certificate');

});

Route::get('/', LandingPageController::class)->name('welcome');

Route::get('/terminos-y-condiciones', TermsForUsersPageController::class)->name('terms-for-users');

Route::get('/terminos-y-condiciones-organizaciones', TermsForTeamsPageController::class)->name('terms-for-teams');

Route::get('/quienes-somos', AboutUsPageController::class)->name('about-us');

Route::get('/fundaciones', TeamPageController::class)->name('teams-page');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::post('/newsletter', NewsletterController::class)->name('newsletter.store');

Route::view('/servicios', 'pricing')->name('pricing');

Route::get('/prohibido', NotAllowedActionController::class)->name('too_many_attempts');

Route::get('/donation-button/{team:slug}', DonationButtonMarkupController::class);

Route::view('/offline', 'vendor/laravelpwa/offline');

Route::redirect('/webinar', 'https://us02web.zoom.us/meeting/register/tZUofuyhrjIjHdxYrTNTNobJb2NmbAdt1Vs0');
