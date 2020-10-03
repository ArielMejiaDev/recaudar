<?php

namespace App\Http\Controllers\Team\Profile;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateTeamThemeController extends Controller
{
    public function __invoke(Request $request, Team $team)
    {
        $request->validate(['theme' => ['required', Rule::in(['classic', 'condensed', 'columns'])]], [], ['theme' => trans('Theme')]);
        $team->update(['theme' => $request->theme]);
        return redirect()->route('teams.profile',$team)->with(['success' => trans('Theme updated!')]);
    }
}
