<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response as ResponseAlias;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return ResponseAlias|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function showLoginForm()
    {
        $trans = [
            'email' => trans('Email'),
            'password' => trans('Password'),
            'forgot_password' => trans('Forgot your password?'),
            'login' => trans('Login'),
            'signup' => trans('Sign up'),
        ];
        return inertia('Auth/Login', compact('trans'));
    }


    public function redirectTo()
    {
        if(auth()->user()->teams->where('role.role_name', 'app_admin')->count()) {
            return route('admin.dashboard');
        }

        return route('teams.index');
    }

}
