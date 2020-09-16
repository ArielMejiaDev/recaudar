<?php

namespace App\Http\Controllers\Admin\Teams;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Team\UpdateTeamLegalDataRequest;
use App\Models\Team;
use Illuminate\Http\Request;

class UpdateTeamLegalData extends Controller
{
    public function __invoke(UpdateTeamLegalDataRequest $request, Team $team)
    {
        $team->update($request->validated());
        return redirect()->route('admin.teams.index')->with(['success' => trans('Team legal data updated!')]);
    }
}
