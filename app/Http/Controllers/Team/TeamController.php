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
        $trans =  [
            'your_teams' => trans('Your Teams'),
            'in_this_section_you_can_manage_your_teams' => trans('In this section you can manage your teams.'),
        ];
        return Inertia::render('Teams/Index', compact('teams', 'trans'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return InertiaResponse
     */
    public function create()
    {
        $trans = [
            'create_a_team' => trans('Create a Team'),
            'profile' => trans('Profile'),
            'the_data_in_this_section_will_be_displayed_on_the_profile_page' => trans('The data in this section will be displayed on the profile page.'),
            'organization_name' => trans('Organization Name'),
            'beneficiaries' => trans('Beneficiaries'),
            'public' => trans('Public'),
            'category' => trans('Category'),
            'impact' => trans('Impact'),
            'use_of_funds' => trans('Use Of Funds'),
            'description' => trans('Description'),
            'contact' => trans('Contact'),
            'this_information_will_not_be_publicly_visible' => trans('This information will not be publicly visible.'),
            'contact_phone' => trans('Contact Phone'),
            'contact_email' => trans('Contact Email'),
            'office_address' => trans('Office Address'),
            'financial_data' => trans('Financial Data'),
            'legal_representative' => trans('Legal Representative'),
            'tax_number' => trans('Tax Number'),
            'country' => trans('Country'),
            'account_number' => trans('Account Number'),
            'bank' => trans('Bank'),
            'accept_terms' => trans('Accept Terms & Conditions'),
            'you_must_accept_terms_to_create_a_team' => trans('You must accept terms to create a team.'),
            'you_will_receive_an_email_when_the_organization_is_approved' => trans('You will receive an email, when the organization is approved.'),
            'cancel' => trans('Cancel'),
            'this_action_cannot_be_reversed' => trans('This action cannot be reversed.')
        ];
        return Inertia::render('Teams/Create', compact('trans'));
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
        return redirect()->route('teams.index')->with([
            'success' => trans('Team') . ' ' . trans('Created') . ', ' . trans('You will receive an email, when the organization is approved.')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Team $team
     * @return InertiaResponse
     */
    public function edit(Team $team)
    {
        $trans = [
            'update_a_team' => trans('Update a Team'),
            'profile' => trans('Profile'),
            'the_data_in_this_section_will_be_displayed_on_the_profile_page' => trans('The data in this section will be displayed on the profile page.'),
            'organization_name' => trans('Organization Name'),
            'beneficiaries' => trans('Beneficiaries'),
            'public' => trans('Public'),
            'category' => trans('Category'),
            'impact' => trans('Impact'),
            'use_of_funds' => trans('Use Of Funds'),
            'description' => trans('Description'),
            'contact' => trans('Contact'),
            'this_information_will_not_be_publicly_visible' => trans('This information will not be publicly visible.'),
            'contact_phone' => trans('Contact Phone'),
            'contact_email' => trans('Contact Email'),
            'office_address' => trans('Office Address'),
            'financial_data' => trans('Financial Data'),
            'legal_representative' => trans('Legal Representative'),
            'tax_number' => trans('Tax Number'),
            'country' => trans('Country'),
            'account_number' => trans('Account Number'),
            'bank' => trans('Bank'),
            'accept_terms' => trans('Accept Terms & Conditions')
        ];

        return Inertia::render('Teams/Edit', compact('team', 'trans'));
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
        return redirect()->route('teams.index')->with(['success' => trans('Team') . ' ' . trans('Updated') . '!']);
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
        return redirect()->route('teams.index')->with(['warning' => trans('Team') . ' ' . trans('Deleted')]);
    }
}
