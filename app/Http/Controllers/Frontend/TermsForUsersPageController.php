<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\SEO\LandingPageSeoService;
use Illuminate\Http\Request;

class TermsForUsersPageController extends Controller
{
    public function __invoke()
    {
        (new LandingPageSeoService)->execute();
        return view('terms-for-users');
    }
}
