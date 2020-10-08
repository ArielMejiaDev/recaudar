<?php

namespace App\Http\Controllers\Admin\Teams;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Notifications\TeamStatusChangeNotification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateTeamStatus extends Controller
{
    public function __invoke(Request $request, Team $team)
    {
        $request->validate(['status' => Rule::in(['pending', 'approved'])]);
        $team->update(['status' => $request->status === 'pending' ? $status = 'approved' : $status = 'pending']);
        $team->users->first()->notify(new TeamStatusChangeNotification($team->name, $status));
        return redirect()->route('admin.teams.index')->with(['success' => trans('team') . ' ' . trans('Updated')]);
    }
}
