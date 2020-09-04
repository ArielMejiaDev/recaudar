<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $teams = auth()->user()->teams()->select('slug', 'name', 'category')->get();
        return Inertia::render('Dashboard/Index', compact('teams'));
    }
}
