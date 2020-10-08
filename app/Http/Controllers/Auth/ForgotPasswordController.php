<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function showLinkRequestForm()
    {
        $trans = [
            'reset_password' => trans('Reset Password'),
            'remembered_your_password' => trans('Remembered Your Password?'),
            'login' => trans('Login'),
            'email' => trans('Email'),
            'your_email_address' => trans('Your Email Address'),
            'email_password_reset_link' => trans('Email Password Reset Link'),
            'we_have_emailed_your_password_reset_link' => trans('We have e-mailed your password reset link!'),
        ];

        $sitekey = config('recaptcha.api_site_key');

        return inertia('Auth/Passwords/Email', compact('trans', 'sitekey'));
    }
}
