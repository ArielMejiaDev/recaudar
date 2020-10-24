<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class DonationButtonMarkupController extends Controller
{
    public function __invoke(Team $team)
    {
        \Debugbar::disable();
        $url = route('profile-page', ['team' => $team]);
        return view('donation-button')->with(['url' => $url]);
    }
}
