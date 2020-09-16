<?php

namespace App\Http\Controllers\Admin\Admins;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\TeamAttachment;
use App\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Admins/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
        ]);
        \request()->request->add(['role' => 'app_admin']);
        TeamAttachment::addUserTo(Team::whereName('recaudar')->first());
        return redirect()->route('admin.dashboard')->with(['success' => trans('Admin created!')]);
    }
}
