<?php

namespace App\Http\Controllers\Team\Profile;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class UpdateTeamSocialNetworksController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Team $team
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Team $team)
    {
        $request->validate([
            'facebook_account' => 'nullable|url',
            'twitter_account' => 'nullable|url',
            'instagram_account' => 'nullable|url',
        ]);

        $this->validateAndUpdate(collect(['facebook_account', 'twitter_account', 'instagram_account']), $team);

        return redirect()->back()->with(['success' => trans('Social networks updated!')]);
    }

    public function validateAndUpdate($inputNames, $model)
    {
        $inputNames->each(function($inputName) use($model) {

            if(\request()->$inputName) {
                $model->update([$inputName => request()->$inputName]);
            }

        });
    }
}
