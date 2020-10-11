<?php

namespace App\Http\Controllers\Team\Profile;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TeamProfileController extends Controller
{
    private array $trans;

    public function __construct()
    {
        $this->trans = [
            'profile' => trans('Profile'),
            'this_is_the_logo_for_the_profile_page' => trans('This is the logo for the profile page.'),
            'upload' => trans('Upload'),
            'this_is_the_banner_for_the_profile_page' => trans('This is the banner for the profile page.'),
            'theme' => trans('Theme'),
            'social_networks' => trans('Social Networks'),
            'facebook_account' => trans('Facebook Account'),
            'twitter_account' => trans('Twitter Account'),
            'instagram_account' => trans('Instagram Account'),
            'promotional_video' => trans('Promotional Video'),
            'add_a_link' => trans('Add a Link'),
        ];
    }

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
            'trans' => $this->trans,
        ]);
    }
}
