<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function show(Request $request)
    {
        $trans = [
            'verify_your_email_address' => trans('Verify Your Email Address'),
            'resend_verification_email' => trans('Resend Verification Email'),
            'please_click_the_button_below_to_verify_your_email_address' => trans('Please click the button below to verify your email address.'),
        ];

        return $request->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        : inertia('Auth/Verify', compact('trans'));
    }

    public function redirectTo()
    {
        if(auth()->user()->teams->where('role.role_name', 'app_admin')->count()) {
            return route('admin.dashboard');
        }

        return route('teams.index');
    }
}
