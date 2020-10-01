<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\LocaleCodeResolver;
use Illuminate\Http\Request;

class DonateDirectLinkController extends Controller
{
    public function __invoke(Request $request, Team $team, $amount = null)
    {
        $locale = new LocaleCodeResolver;

        $plan = $amount ?
            $team->availablePlans()->where('amount_in_local_currency', $amount)->first() ?? $team->variablePlan()
            : $team->variablePlan();

        return view('donate-direct-link', [
            'team' => $team,
            'locale' => $locale->getLocaleFrom($team->country),
            'variablePlanId' => $team->plans->first()->id,
            'amount' => $amount,
            'plan' => $plan
        ]);
    }
}
