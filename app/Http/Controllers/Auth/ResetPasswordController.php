<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        $trans = [
            'reset_password' => trans('Reset Password'),
            'remembered_your_password' => trans('Remembered Your Password?'),
            'login' => trans('Login'),
            'email' => trans('Email'),
            'password' => trans('Password'),
            'your_password' => trans('Your Password'),
            'confirm_password' => trans('Confirm Password'),
            'confirm_your_password' => trans('Confirm Your Password'),
            'your_email_address' => trans('Your Email Address'),
        ];

        return inertia('Auth/Passwords/Reset', [
            'token' => $token,
            'email' => $request->email,
            'trans' => $trans,
        ]);
    }

    public function redirectTo()
    {
        if(auth()->user()->teams->where('role.role_name', 'app_admin')->count()) {
            return route('admin.dashboard');
        }

        return route('teams.index');
    }
}
