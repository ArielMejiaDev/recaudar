<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\ProfileUpdatePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Throwable;

class ProfileUpdatePasswordController extends Controller
{
    /**
     * Get the failed login response instance.
     *
     * @param ProfileUpdatePasswordRequest $request
     * @return RedirectResponse
     *
     * @throws Throwable
     */
    public function __invoke(ProfileUpdatePasswordRequest $request)
    {
        throw_unless($this->passwordMatch($request->get('password')),
            ValidationException::withMessages([
                'password' => [trans('Your current password does not match!')],
            ])
        );
        auth()->user()->update([
            'password' => Hash::make($request->get('new_password'))
        ]);
        return redirect()->route('profile.show')->with(['success' => trans('Profile') . ' ' . trans('Updated')]);
    }

    public function passwordMatch(String $password)
    {
        return Hash::check($password, auth()->user()->password);
    }
}
