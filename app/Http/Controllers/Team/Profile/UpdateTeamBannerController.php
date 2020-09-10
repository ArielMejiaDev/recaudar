<?php

namespace App\Http\Controllers\Team\Profile;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\S3Uploader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UpdateTeamBannerController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Team $team
     * @return RedirectResponse
     */
    public function __invoke(Request $request, Team $team)
    {
        $request->validate(['banner' => 'required|image']);
        $team->update(['banner' => S3Uploader::upload('banner', 'teams_banners', $team->banner)]);
        return redirect()->route('teams.profile', $team)->with(['success' => trans('Banner updated!')]);
    }
}
