<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
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
        $this->middleware('auth');
    }

    /**
     * Display the password confirmation view.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function showConfirmForm()
    {
        return inertia('Auth/Passwords/Confirm');
    }

    public function redirectTo()
    {
        if(auth()->user()->teams->where('role.role_name', 'app_admin')->count() ||
            auth()->user()->teams->where('role.role_name', 'app_editor')->count() ||
            auth()->user()->teams->where('role.role_name', 'app_financial')->count()) {
            return route('admin.dashboard');
        }

        return route('teams.index');
    }
}
