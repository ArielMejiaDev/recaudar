<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\SEO\LandingPageSeoService;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function __invoke()
    {
        (new LandingPageSeoService)->execute();
        return view('welcome', [
            'team' => Team::where('name', '!=', 'recaudar')->where('status', 'approved')->whereNotNull('logo')->inRandomOrder()->limit(1)->first(),
            'teams' => Team::where('name', '!=', 'recaudar')->where('status', 'approved')->whereNotNull('logo')->inRandomOrder()->limit(3)->get(),
        ]);
    }
}
