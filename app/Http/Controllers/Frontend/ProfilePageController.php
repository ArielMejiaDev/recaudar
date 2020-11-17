<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\LocaleCodeResolver;
use App\Services\SEO\TeamProfilePageSeoService;
use Illuminate\Http\Request;

class ProfilePageController extends Controller
{
    public function __invoke(Team $team)
    {
        if($team->status !== 'approved') return abort(404);

        $locale = new LocaleCodeResolver;
        (new TeamProfilePageSeoService)->execute($team);

        return view('teams/themes/' . $team->theme, [
            'team' => $team,
            'locale' => $locale->getLocaleFrom($team->country),
            'variablePlan' => $team->plans->first(),
        ]);
    }
}
