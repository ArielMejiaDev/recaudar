<?php

namespace App\Http\Controllers\Admin\Teams;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $teams = Team::select(['id', 'name', 'status'])->where('name', '!=', 'recaudar')->paginate(10);

        if($request->has('search')) {
            $teams = Team::select(['id', 'name', 'status'])
                ->where('name', 'LIKE', "%{$request->search}%")
                ->where('name', '!=', 'recaudar')
                ->paginate(10);
        }

        return Inertia::render('Admin/Teams/Index', [
            'teams' => $teams,
            'filters' => $request->only('search'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Team $team
     * @return Response
     */
    public function edit(Team $team)
    {
        return Inertia::render('Admin/Teams/Edit', ['team' => $team]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Team $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
}
