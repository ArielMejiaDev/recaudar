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
        (new TeamProfilePageSeoService)->execute($team);
        $locale = new LocaleCodeResolver;
        return view('teams/themes/' . $team->theme, [
            'team' => $team,
            'locale' => $locale->getLocaleFrom($team->country),
            'variablePlanId' => $team->plans->first()->id,
        ]);
    }
}
