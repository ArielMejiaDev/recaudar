<?php

namespace App\Http\Controllers\Admin\Teams;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Team\UpdateTeamFinancialDataRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UpdateTeamFinancialData extends Controller
{
    public function __invoke(UpdateTeamFinancialDataRequest $request, Team $team)
    {
        Gate::authorize('manage-teams');
        $team->update($request->validated());
        return redirect()->route('admin.teams.index')->with(['success' => trans('team') . ' ' . trans('Updated')]);
    }
}
