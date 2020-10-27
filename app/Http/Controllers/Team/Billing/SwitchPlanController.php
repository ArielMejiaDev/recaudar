<?php

namespace App\Http\Controllers\Team\Billing;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class SwitchPlanController extends Controller
{
    private array $trans;

    public function __construct()
    {
        $this->trans = [
            'title' => trans('Switch Plan.'),
            'subtitle' => trans('The plan is going to be apply until your next billing date.'),
            'update_plan' => trans('Update Plan'),
            'cancel' => trans('Cancel'),
            'modal_title' => trans('Are you sure to update the plan?'),
            'modal_info' => trans('This change will be reflect on your billing plan.'),
            'free_plan_info' => trans('The rate 8% + Q2.00 per transaction.'),
            'pro_plan_info' => trans('The rate 5.5% + Q2.00 per transaction.'),
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param Team $team
     * @return \Inertia\Response
     */
    public function show(Team $team)
    {
        Gate::authorize('switch-plan');
        $team = $team->only(['id', 'name', 'slug', 'plan']);
        return Inertia::render('Teams/Billing/SwitchPlan')->with([
            'team' => $team,
            'trans' => $this->trans,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Team $team
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Team $team)
    {
        Gate::authorize('switch-plan');
        $request->validate(['plan' => Rule::in(['free', 'pro'])]);
        $team->update(['plan' => $request->get('plan')]);
        return redirect()->back()->with(['success' => trans('Billing Plan Updated.')]);
    }

}
