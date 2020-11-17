<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AddContactFromProfilePageController extends Controller
{
    public function __invoke(Request $request, Team $team)
    {
        $request->validate(['email' => ['required', 'email', Rule::unique('contacts')]]);

        Contact::create(['email' => $request->get('email'), 'team_id' => $team->id]);

        return redirect()->back()->with(['success' => trans('Email added.')]);
    }
}
