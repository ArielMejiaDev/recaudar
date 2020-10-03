<?php namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\ProfileUpdateCredentialsRequest;

class ProfileUpdateCredentialsController extends Controller
{
    public function __invoke(ProfileUpdateCredentialsRequest $request)
    {
        auth()->user()->update($request->only('name', 'email'));
        return redirect()->route('profile.show')->with(['success' => trans('Profile') . ' ' . trans('Updated')]);
    }
}
