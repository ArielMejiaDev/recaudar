<?php

namespace App\Http\Controllers\Admin\Teams;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Team\UpdateTeamContactRequest;
use App\Models\Team;
use Illuminate\Http\Request;

class UpdateTeamContact extends Controller
{
    public function __invoke(UpdateTeamContactRequest $request, Team $team)
    {
        $team->update($request->validated());
        return redirect()->route('admin.teams.index')->with(['success' => trans('team') . ' ' . trans('Updated')]);
    }
}
