<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\SEO\TeamPageSeoService;
use Illuminate\Http\Request;

class TeamPageController extends Controller
{
    public function __invoke(Request $request)
    {
        $teams = Team::where('name', '!=', 'recaudar')->where('status', 'approved')->simplePaginate();
        if($request->has('categoria')) {
            $teams = Team::where('name', '!=', 'recaudar')->where('status', 'approved')->whereCategory(ucfirst($request->categoria))->simplePaginate();
        }
        (new TeamPageSeoService)->execute();
        return view('teams-page', compact('teams'));
    }
}
