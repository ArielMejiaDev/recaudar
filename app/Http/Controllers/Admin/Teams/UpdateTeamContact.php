<?php

namespace App\Http\Controllers\Admin\Teams;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Team\UpdateTeamContactRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UpdateTeamContact extends Controller
{
    public function __invoke(UpdateTeamContactRequest $request, Team $team)
    {
        Gate::authorize('manage-teams');
        $team->update($request->validated());
        return redirect()->route('admin.teams.index')->with(['success' => trans('team') . ' ' . trans('Updated')]);
    }
}
