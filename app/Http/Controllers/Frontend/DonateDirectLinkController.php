<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\LocaleCodeResolver;
use App\Services\SEO\TeamProfilePageSeoService;
use Illuminate\Http\Request;

class DonateDirectLinkController extends Controller
{
    public function __invoke(Request $request, Team $team, $amount = null)
    {
        if($team->status !== 'approved') return abort(404);

        $plan = $amount ?
            $team->availablePlans()->where('amount_in_local_currency', $amount)->first() ?? $team->variablePlan()
            : $team->variablePlan();

        (new TeamProfilePageSeoService)->execute($team);

        return view('donate-direct-link', [
            'team' => $team,
            'locale' => (new LocaleCodeResolver)->getLocaleFrom($team->country),
            'variablePlanId' => $team->plans->first()->id,
            'amount' => $amount,
            'plan' => $plan
        ]);
    }
}
