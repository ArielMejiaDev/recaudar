<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function __invoke()
    {
        return view('welcome', [
            'team' => Team::where('name', '!=', 'recaudar')->inRandomOrder()->limit(1)->first(),
            'teams' => Team::where('name', '!=', 'recaudar')->inRandomOrder()->limit(3)->get(),
        ]);
    }
}
