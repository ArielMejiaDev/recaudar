<?php

namespace App\Http\Controllers\Team\Profile;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UpdateTeamPromotionalVideoController extends Controller
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
        $request->validate(['promotional_video' => 'nullable|url'], [], ['promotional_video' => trans('Promotional Video')]);
        $team->update(['promotional_video' => $request->promotional_video]);
        return redirect()->route('teams.profile', $team)->with(['success' => trans('Video Updated')]);
    }
}
