<?php

namespace App\Http\Controllers\Team\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\Profile\UpdateTeamSocialNetworksRequest;
use App\Models\Team;
use Illuminate\Http\Request;

class UpdateTeamSocialNetworksController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Team $team
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateTeamSocialNetworksRequest $request, Team $team)
    {
        $request->validate([
            'facebook_account' => ['nullable', 'url'],
            'twitter_account' => ['nullable', 'url'],
            'instagram_account' => ['nullable', 'url'],
        ]);

        $team->update($request->validated());

        return redirect()->back()->with(['success' => trans('Social Links Updated')]);
    }
}
