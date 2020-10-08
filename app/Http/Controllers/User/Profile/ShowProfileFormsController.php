<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as ResponseAlias;

class ShowProfileFormsController extends Controller
{
    /**
     * @return ResponseAlias
     */
    public function __invoke()
    {
        $trans = [
            'profile' => trans('Profile'),
            'change_credentials' => trans('Change Credentials'),
            'name' => trans('Name'),
            'email' => trans('Email'),
            'this_are_the_credentials_to_login' => trans('This are the credentials to login.'),
            'change_password' => trans('Change Password'),
            'be_careful_if_you_change_the_password' => trans('Be careful, if you change the password.'),
            'you_must_confirm_the_new_password_to_update_it' => trans('You must confirm the new password to update it.'),
            'password' => trans('Password'),
            'new_password' => trans('New Password'),
            'confirm_password' => trans('Confirm Password'),
            'change_avatar' => trans('Change Avatar'),
            'the_avatar_would_be_public' => trans('The avatar would be public.'),
            'upload' => trans('Upload'),
        ];

        return Inertia::render('User/Profile/Show', ['trans' => $trans, 'avatar' => auth()->user()->avatar]);
    }
}
