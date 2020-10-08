<?php

namespace App\Http\Controllers\Admin\Admins;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\TeamAttachment;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{

    private array $trans;

    public function __construct()
    {
        $this->trans = [
            'title' => trans('Create an application administrator user.'),
            'subtitle' => trans('The user can manage the entire application.'),
            'name' => trans('Name'),
            'email' => trans('Email'),
            'create' => trans('Create'),
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Admin/Admins/Create', ['trans' => $this->trans]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
        ]);
        \request()->request->add(['role' => 'app_admin']);
        TeamAttachment::addUserTo(Team::whereName('recaudar')->first());
        return redirect()->route('admin.dashboard')->with(['success' => trans('Admin') . ' ' . trans('Created')]);
    }
}
