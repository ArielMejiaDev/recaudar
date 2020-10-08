<?php

namespace App\Http\Controllers\Admin\Teams;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Team\UpdateTeamProfileRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateTeamProfile extends Controller
{
    public function __invoke(UpdateTeamProfileRequest $request, Team $team)
    {
        $team->update($request->validated());
        return redirect()->route('admin.teams.index')->with(['success' => trans('team') . ' ' . trans('Updated')]);
    }
}
