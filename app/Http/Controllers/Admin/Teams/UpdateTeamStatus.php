<?php

namespace App\Http\Controllers\Admin\Teams;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class UpdateTeamStatus extends Controller
{
    public function __invoke(Request $request, Team $team)
    {
        $team->update(['status' => $request->status === 'pending' ? 'approved' : 'pending']);
        return redirect()->route('admin.teams.index')->with(['success' => trans('Team updated!')]);
    }
}
