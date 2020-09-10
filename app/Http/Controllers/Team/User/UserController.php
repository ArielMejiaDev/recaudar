<?php

namespace App\Http\Controllers\Team\User;

use App\Exceptions\UserCannotBeAttachedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\User\StoreUserRequest;
use App\Models\Role;
use App\Models\Team;
use App\Notifications\ExistingUserTeamInvitation;
use App\Notifications\NewUserTeamInvitation;
use App\Notifications\TeamInvitation;
use App\Services\TeamAttachment;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Team $team
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Team $team, Request $request)
    {
        $users = $team->users()->select(['users.id', 'users.name'])->where('users.id', '!=', auth()->id())->paginate(5);

        if ($request->has('search')) {
            $users = $team->users()
                ->select(['users.id', 'users.name'])
                ->where('name', 'LIKE' , "%{$request->search}%")
                ->where('users.id', '!=', auth()->id())
                ->paginate(5);
        }

        return Inertia::render('Teams/Users/Index', [
            'team' => $team->only('name', 'slug'),
            'filters' => $request->all('search'),
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Team $team
     * @return \Inertia\Response
     */
    public function create(Team $team)
    {
        return Inertia::render('Teams/Users/Create', ['team' => $team->only('name', 'slug')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Team $team
     * @param StoreUserRequest $request
     * @return RedirectResponse
     * @throws UserCannotBeAttachedException
     */
    public function store(Team $team, StoreUserRequest $request)
    {
        TeamAttachment::addUserTo($team);
        return redirect()->route('teams.users.index', $team)->with(['success' => trans('User invited!')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Team $team
     * @param User $user
     * @return \Inertia\Response
     */
    public function edit(Team $team, User $user)
    {
        return Inertia::render('Teams/Users/Edit', [
            'team' => $team->only('name', 'slug'),
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Team $team
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Team $team , Request $request, User $user)
    {
        $request->validate(['role' => Rule::in(['team_admin', 'team_editor', 'team_financial', 'team_member']) ]);
        $user->teams()->updateExistingPivot($team, ['role_name' => $request->role]);
        return redirect()->route('teams.users.index', $team)->with(['success' => trans('User role updated!')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Team $team
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(Team $team, User $user)
    {
        $user->teams()->detach($team);
        return redirect()->route('teams.users.index', $team)->with(['warning' => trans('User access removed!')]);
    }
}
