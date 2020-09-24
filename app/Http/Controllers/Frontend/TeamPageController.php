<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamPageController extends Controller
{
    public function __invoke(Request $request)
    {
        $teams = Team::where('name', '!=', 'recaudar')->where('status', 'approved')->simplePaginate();
        if($request->has('categoria')) {
            $teams = Team::where('name', '!=', 'recaudar')->whereCategory(ucfirst($request->categoria))->simplePaginate();
        }
        return view('teams-page', compact('teams'));
    }
}
