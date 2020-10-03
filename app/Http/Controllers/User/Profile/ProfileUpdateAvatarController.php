<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\ProfileUpdateAvatarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileUpdateAvatarController extends Controller
{
    public function __invoke(ProfileUpdateAvatarRequest $request)
    {
        $file = $request->file('avatar')->store('avatars', 's3');
        Storage::disk('s3')->delete('avatars/' . basename(auth()->user()->avatar));
        Storage::disk('s3')->setVisibility($file, 'public');
        auth()->user()->update(['avatar' =>  Storage::disk('s3')->url($file)]);
        return redirect()->route('profile.show')->with(['success' => trans('Profile') . ' ' . trans('Updated')]);
    }
}
