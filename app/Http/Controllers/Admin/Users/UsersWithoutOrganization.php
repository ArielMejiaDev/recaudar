<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UsersWithoutOrganization extends Controller
{
    private array $trans;

    public function __construct()
    {
        $this->trans = [
            'title' => trans('Users without a team'),
            'name' => trans('Name'),
            'email' => trans('Email'),
            'created' => trans('Created'),
            'search' => trans('Search'),
        ];
    }

    public function __invoke(Request $request)
    {
        // falta filtros
        $users = User::doesntHave('teams')->paginate(5);
        if ($request->get( 'search')) {
            $users = User::doesntHave('teams')
                ->where('name', 'LIKE', "%{$request->get('search')}%")
                ->orWhere('email', 'LIKE', "%{$request->get('search')}%")
                ->paginate(5);
        }

        return Inertia::render('Admin/Users/UsersWithoutTeam/Index')->with([
            'users' => $users,
            'trans' => $this->trans,
            'filters' => $request->only('search'),
        ]);
    }
}
