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
use Illuminate\Support\Str;
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

        $trans = [
            'users' => trans('Users'),
            'user' => trans('User'),
            'role' => trans('Role'),
            'remove_access_to' => trans('Remove Access To'),
            'remove_access' => trans('Remove Access'),
            'you_can_invite_again_the_user_anytime' => trans('You can invite again the user anytime.'),
            'invite_a_user' => trans('Invite a User'),
            'admin' => trans('Admin'),
            'editor' => trans('Editor'),
            'financial' => trans('Financial'),
            'member' => trans('Member')
        ];

        return Inertia::render('Teams/Users/Index', [
            'team' => $team->only('name', 'slug'),
            'filters' => $request->all('search'),
            'users' => $users,
            'trans' => $trans,
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
        $trans = [
            'create_a_user' => trans('Create a User'),
            'the_user_role_defines_the_actions_that_a_user_can_do' => trans('The user role defines the actions that a user can do.'),
            'name' => trans('Name'),
            'email' => trans('Email'),
            'role' => trans('Role'),
            'admin' => trans('Admin'),
            'editor' => trans('Editor'),
            'financial' => trans('Financial'),
            'member' => trans('Member')
        ];

        return Inertia::render('Teams/Users/Create', ['team' => $team->only('name', 'slug'), 'trans' => $trans]);
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
        return redirect()->route('teams.users.index', $team)->with(['success' => trans('User') . ' ' . trans('Created')]);
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
        $trans = [
            'role' => trans('Role'),
            'edit_role_of' => trans('Edit Role Of'),
            "the_user_role_defines_the_actions_that_a_user_can_do" => trans('The user role defines the actions that a user can do'),
            'admin' => trans('Admin'),
            'editor' => trans('Editor'),
            'financial' => trans('Financial'),
            'member' => trans('Member'),
        ];

        return Inertia::render('Teams/Users/Edit', [
            'team' => $team->only('name', 'slug'),
            'user' => $user,
            'trans' => $trans,
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
        return redirect()->route('teams.users.index', $team)->with(['success' => trans('User') . ' ' . trans('Updated')]);
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
        return redirect()->route('teams.users.index', $team)->with(['warning' => trans('User') . ' ' . trans('Deleted')]);
    }
}
