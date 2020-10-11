<?php

namespace App\Http\Controllers\Admin\Teams;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Notifications\TeamStatusChangeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use mysql_xdevapi\Exception;

class UpdateTeamStatus extends Controller
{
    public function __invoke(Request $request, Team $team)
    {
        Gate::authorize('manage-teams');
        $request->validate(['status' => Rule::in(['pending', 'approved'])]);
        $team->update(['status' => $request->status === 'pending' ? $status = 'approved' : $status = 'pending']);
        try {
            $team->users->first()->notify(new TeamStatusChangeNotification($team->name, $status));
        }catch (\Exception $exception) {
            \Log::error('TeamStatusChangeNotification fail.');
        }
        return redirect()->route('admin.teams.index')->with(['success' => trans('Team Updated')]);
    }
}
