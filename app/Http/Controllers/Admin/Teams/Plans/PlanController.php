<?php

namespace App\Http\Controllers\Admin\Teams\Plans;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Team\Plan\UpdatePlanRequest;
use App\Models\Plan;
use App\Models\Team;
use App\Services\LocaleCodeResolver;
use App\Services\S3Uploader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Team $team
     * @return \Inertia\Response
     */
    public function index(Request $request, Team $team)
    {
        $plans = $team->plans()->where('title', '!=', 'of variable amount')->paginate(10, ['plans.id', 'title', 'amount_in_local_currency', 'amount_in_dollars']);

        if($request->has('search')) {
            $plans = $team->plans()->where('title', '!=', 'of variable amount')
                ->where(function($query) use($request) {
                $query->where('title', 'LIKE', "%{$request->search}%")
                    ->orWhere('amount_in_local_currency', 'LIKE', "%{$request->search}%")
                    ->orWhere('amount_in_dollars', 'LIKE', "%{$request->search}%");
            })->paginate(10, ['plans.id', 'title', 'amount_in_local_currency', 'amount_in_dollars']);
        }

        $team = $team->only('id', 'name');
        $filters = $request->only('search');
        return Inertia::render('Admin/Teams/Plans/Index', compact('plans','team', 'filters'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Team $team
     * @param Plan $plan
     * @return \Inertia\Response
     */
    public function edit(Team $team, Plan $plan)
    {
        $locale = (new LocaleCodeResolver)->getLocaleFrom($team->country);
        return Inertia::render('Admin/Teams/Plans/Edit', [
            'plan' => $plan,
            'team' => $team->only(['id', 'name']),
            'locale' => [
                'country' => $locale->countryCode(),
                'currency' => $locale->currencyCode(),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePlanRequest $request
     * @param Team $team
     * @param Plan $plan
     * @return RedirectResponse
     */
    public function update(UpdatePlanRequest $request, Team $team, Plan $plan)
    {
        $data = $request->only('title', 'info', 'amount_in_local_currency', 'amount_in_dollars');
        if($request->hasFile('banner')) {
            $file = S3Uploader::upload('banner', 'plans_banners', $request->banner);
            $data = array_merge(['banner' => $file], $data);
        }
        $plan->update($data);
        return redirect()->route('admin.teams.plans.index', $team)->with(['success' => trans('Plan updated!')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Plan $plan
     * @return Response
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
