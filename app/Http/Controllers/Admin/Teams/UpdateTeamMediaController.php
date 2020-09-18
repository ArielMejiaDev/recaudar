<?php

namespace App\Http\Controllers\Admin\Teams;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\S3Uploader;
use Illuminate\Http\Request;

class UpdateTeamMediaController extends Controller
{
    /**
     * @param Request $request
     * @param Team $team
     */
    public function __invoke(Request $request, Team $team)
    {
        $request->validate([
            'logo' => ['nullable', 'image', 'max:512'],
            'banner' => ['nullable', 'image', 'max:512'],
        ]);
        if($request->hasFile('banner')) {
            $banner = S3Uploader::upload('banner', 'teams_banners', $team->banner);
            $team->banner = $banner;
        }
        if($request->hasFile('logo')) {
            $logo = S3Uploader::upload('logo', 'teams_logos', $team->logo);
            $team->logo = $logo;
        }
        $team->save();
        return redirect()->route('admin.teams.index')->with(['success' => trans('Team media updated!')]);
    }
}
