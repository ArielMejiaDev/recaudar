<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamDashboardController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Team/Dashboard/Index');
    }
}
