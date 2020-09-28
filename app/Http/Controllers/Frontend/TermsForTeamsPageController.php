<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TermsForTeamsPageController extends Controller
{
    public function __invoke()
    {
        return view('terms-for-teams');
    }
}
