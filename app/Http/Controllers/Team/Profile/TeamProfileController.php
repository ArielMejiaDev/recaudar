<?php

namespace App\Http\Controllers\Team\Profile;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TeamProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param Team $team
     * @return Response
     */
    public function __invoke(Team $team)
    {
        return Inertia::render('Teams/Profile/Edit', [
            'team' => $team,
        ]);
    }
}
