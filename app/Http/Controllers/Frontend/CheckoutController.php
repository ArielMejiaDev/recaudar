<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __invoke(Request $request, Team $team)
    {
        return view('teams.checkout', ['amount' => $request->amount, 'team' => $team]);
    }
}
