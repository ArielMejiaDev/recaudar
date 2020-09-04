<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as ResponseAlias;

class ShowProfileFormsController extends Controller
{
    /**
     * @return ResponseAlias
     */
    public function __invoke()
    {
        return Inertia::render('User/Profile/Show');
    }
}
