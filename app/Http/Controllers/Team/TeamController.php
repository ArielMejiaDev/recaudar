<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\StoreTeamRequest;
use App\Http\Requests\Team\UpdateTeamRequest;
use App\Models\Team;
use App\Notifications\NewTeamCreatedNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class TeamController extends Controller
{
    public function index()
    {
        $teams = auth()->user()->teams()->select('slug', 'name', 'category')->whereStatus('approved')->get();
        return Inertia::render('Teams/Index', compact('teams'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return InertiaResponse
     */
    public function create()
    {
        return Inertia::render('Teams/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTeamRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTeamRequest $request)
    {
        $data = array_merge(['slug' => Str::slug($request->name), 'status' => 'pending'], $request->validated());
        unset($data['terms']);
        $team = Team::create($data);
        auth()->user()->teams()->attach($team, ['role_name' => 'admin']);
        Notification::route('mail', 'info@recaudar.com')->notify(new NewTeamCreatedNotification($team, auth()->user()));
        return redirect()->route('teams.index')->with(['success' => trans('the team was created successfully, you will receive an email when it is approved')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Team $team
     * @return InertiaResponse
     */
    public function edit(Team $team)
    {
        return Inertia::render('Teams/Edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTeamRequest $request
     * @param Team $team
     * @return RedirectResponse
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $team->update($request->validated());
        return redirect()->route('teams.index')->with(['success' => trans('Team updated!')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Team $team
     * @return RedirectResponse
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('teams.index')->with(['warning' => trans('Team deleted!')]);
    }
}
