<?php

namespace App\Http\Controllers\Team\Profile;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\S3Uploader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateTeamLogoController extends Controller
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
        $request->validate(['logo' => 'required|image']);
        $team->update(['logo' => S3Uploader::upload('logo', 'teams_logos', $team->logo)]);
        return redirect()->route('teams.profile', $team)->with(['success' => trans('Logo Updated')]);
    }
}
