<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\LocaleCodeResolver;
use Illuminate\Http\Request;

class ProfilePageController extends Controller
{
    public function __invoke(Team $team)
    {
        $plans = $team->plans()->where('title', '!=', 'of variable amount')->orderBy('amount_in_local_currency')->limit(3)->get();
        $locale = new LocaleCodeResolver;
        return view('teams/themes/' . $team->theme, [
            'team' => $team,
            'plans' => $plans,
            'locale' => $locale->getLocaleFrom($team->country),
            'variablePlanId' => $team->plans->first()->id,
        ]);
    }
}
