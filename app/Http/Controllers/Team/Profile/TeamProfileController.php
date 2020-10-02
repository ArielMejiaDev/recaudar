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
        $data = $team->only('name', 'slug', 'logo', 'banner', 'theme', 'avatar', 'promotional_video', 'facebook_account', 'twitter_account', 'instagram_account');
        return Inertia::render('Teams/Profile/Edit', [
            'team' => $data,
        ]);
    }
}
