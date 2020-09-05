<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamDashboardController extends Controller
{
    public function __invoke(Team $team)
    {
        return Inertia::render('Teams/Dashboard/Index');
    }
}
