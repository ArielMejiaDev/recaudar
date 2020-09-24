<?php

namespace App\Http\Controllers\Team\Plans;

use App\Exceptions\FileUploadToS3FailException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\Plan\StorePlanRequest;
use App\Http\Requests\Team\Plan\UpdatePlanRequest;
use App\Models\Plan;
use App\Models\Team;
use App\Services\S3Uploader;
use App\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Team $team
     * @return Response
     */
    public function index(Team $team, Request $request)
    {

        $plans = $team->plans()
            ->where('title', '!=', 'variable amount plan')
            ->select('title', 'type_of_amount', 'currency', 'amount')
            ->paginate(5);

        if ($request->has('search')) {
            $plans = $team->plans()
                        ->select(['title', 'type_of_amount', 'currency', 'amount'])
                        ->where('title', '!=', 'variable amount plan')
                        ->where(function($query) use($request) {
                            $query->where('title', 'LIKE', "%{$request->search}%")
                                ->orWhere('currency', 'LIKE', "%{$request->search}%")
                                ->orWhere('type_of_amount', 'LIKE', "%{$request->search}%")
                                ->orWhere('amount', 'LIKE', "%{$request->search}%");
                        })->paginate(5);
        }

        return Inertia::render('Teams/Plans/Index', [
            'filters' => $request->all('search'),
            'team' => $team->only('name', 'slug'),
            'plans' => $plans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Team $team
     * @return Response
     */
    public function create(Team $team)
    {
        return Inertia::render('Teams/Plans/Create', [
            'team' => $team->only('name', 'slug'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Team $team
     * @param StorePlanRequest $request
     * @return RedirectResponse
     */
    public function store(Team $team, StorePlanRequest $request)
    {
        if($request->hasFile('banner')) {
            $banner = S3Uploader::upload('banner', 'teams_plans_banners');
            $data = array_merge(['banner' => $banner], $request->only('title', 'currency', 'amount_in_local_currency', 'amount_in_dollars', 'info'));
        }
        $team->plans()->create($data ?? $request->only('title', 'currency', 'amount_in_local_currency', 'amount_in_dollars', 'info'));
        return redirect()->route('teams.plans.index', $team)->with(['success' => trans('Plan created!')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Team $team
     * @param Plan $plan
     * @return Response
     */
    public function edit(Team $team, Plan $plan)
    {
        return Inertia::render('Teams/Plans/Edit', [
            'team' => $team->only('name', 'slug'),
            'plan' => $plan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePlanRequest $request
     * @param Team $team
     * @param Plan $plan
     * @return RedirectResponse
     * @throws FileUploadToS3FailException
     */
    public function update(UpdatePlanRequest $request, Team $team, Plan $plan)
    {
        if($request->hasFile('banner')) {
            $banner = S3Uploader::upload('banner', 'teams_plans_banners', $plan->banner);
            $data = array_merge(['banner' => $banner], $request->only('title', 'amount_in_local_currency', 'amount_in_dollars', 'info'));
        }
        $plan->update($data ?? $request->only('title', 'amount_in_local_currency', 'amount_in_dollars', 'info'));
        return redirect()->route('teams.plans.index', $team)->with(['success' => trans('Plan updated!')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Team $team
     * @param Plan $plan
     * @return RedirectResponse
     */
    public function destroy(Team $team, Plan $plan)
    {
        Storage::disk('s3')->delete( 'teams_plans_banners/' . basename($plan->banner));
        $plan->delete();
        return redirect()->route('teams.plans.index', $team)->with(['warning' => trans('Plan deleted!')]);
    }
}
