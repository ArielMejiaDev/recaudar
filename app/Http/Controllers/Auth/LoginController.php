<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
//    protected $redirectTo = RouteServiceProvider::HOME;

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
     * @return ResponseAlias
     */
    public function showLoginForm()
    {
        return inertia('Auth/Login');
    }


    public function redirectTo()
    {
        // Todo
        // search if user has a role of "superadmin" to go to dashboard
        // problem I need to loop over all teams to get the role
        // idea: auth()->user()->teams->where('role.role_name', 'member')->first()

//        if(auth()->user()->roles()->whereName('admin')->exists()) {
//            return route('admin.dashboard');
//        }
        return route('teams.index');
    }
}
