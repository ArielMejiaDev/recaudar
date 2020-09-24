<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class ProfilePageController extends Controller
{
    public function __invoke(Team $team)
    {
        $plans = $team->plans()->orderBy('amount_in_local_currency')->limit(3)->get();
        // a service to resolve currency by country
        $currency = 'Q';
        return view('teams/themes/' . $team->theme, ['team' => $team, 'plans' => $plans, 'currency' => $currency]);
    }
}
