<?php

namespace App\Http\Controllers\Admin\Teams;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class TeamController extends Controller
{
    protected array $trans;

    public function __construct()
    {
        $this->trans = [
            'teams' => trans('Teams'),
            'search' => trans('Search'),
            'team' => trans('Team'),
            'plans' => trans('Plans'),
            'status' => trans('Status'),
            'pending' => trans('Pending'),
            'approved' => trans('Approved'),
            'are_you_sure_to_change_status_of' => trans('Are you sure to change status of'),
            'you_can_switch_status_anytime' => trans('You can switch status anytime.'),
            'profile' => trans('Profile'),
            'name' => trans('Name'),
            'beneficiaries' => trans('Beneficiaries'),
            'public' => trans('Public'),
            'category' => trans('Category'),
            'theme' => trans('Theme'),
            'impact' => trans('Impact'),
            'use_of_funds' => trans('Use Of Funds'),
            'description' => trans('Description'),
            'classic' => trans('Classic'),
            'condensed' => trans('Condesed'),
            'columns' => trans('Columns'),
            'upload' => trans('Upload'),
            'media' => trans('Media'),
            'contact' => trans('Contact'),
            'contact_phone' => trans('Contact Phone'),
            'contact_email' => trans('Contact Email'),
            'office_address' => trans('Office Address'),
            'financial_data' => trans('Financial Data'),
            'legal_representative' => trans('Legal Representative'),
            'tax_number' => trans('Tax Number'),
            'country' => trans('Country'),
            'account_number' => trans('Account Number'),
            'bank' => trans('Bank')
        ];
    }

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

            if(
                Str::contains(
                    Str::lower(trans('Approved')),
                    Str::lower($request->search)
                )
            ) {
                $request->search = 'approved';
            }

            if(
            Str::contains(
                Str::lower(trans('Pending')),
                Str::lower($request->search)
            )
            ) {
                $request->search = 'pending';
            }

            $teams = Team::select(['id', 'name', 'status'])
                ->where('name', 'LIKE', "%{$request->search}%")
                ->where('name', '!=', 'recaudar')
                ->orWhere('status', 'LIKE', "%{$request->search}%")
                ->paginate(10);
        }

        return Inertia::render('Admin/Teams/Index', [
            'teams' => $teams,
            'filters' => $request->only('search'),
            'trans' => $this->trans,
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
        return Inertia::render('Admin/Teams/Edit', [
            'team' => $team,
            'trans' => $this->trans,
        ]);
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
