<?php

namespace App\Http\Controllers\Admin\Charges;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Charge\UpdateOrStoreChargeRequest;
use App\Models\Charge;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class ChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $charges = Charge::orderByDesc('id')->paginate(5);

        if($request->has('search')) {
            $charges = Charge::select(['id', 'country', 'gateway'])->where(function($query) use ($request) {
                return $query->where('country', 'LIKE', "%{$request->search}%")
                    ->orWhere('gateway', 'LIKE', "%{$request->search}%");
            })->orderByDesc('id')->paginate(5);
        }

        return Inertia::render('Admin/Charge/Index', [
            'charges' => $charges,
            'filters' => $request->only('search'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Admin/Charge/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UpdateOrStoreChargeRequest $request
     * @return RedirectResponse
     */
    public function store(UpdateOrStoreChargeRequest $request)
    {
        Charge::create([
            'country' => $request->get('country'),
            'income' => ($request->income / 100),
            'gateway' => $request->get('gateway'),
            'gateway_charge' => ($request->gateway_charge / 100),
        ]);
        return redirect()->route('admin.charges.index')->with(['success' => trans('Charge created!')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Charge $charge
     * @return Response
     */
    public function edit(Charge $charge)
    {
        return Inertia::render('Admin/Charge/Edit', [
            'charge' => $charge,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Charge $charge
     * @return RedirectResponse
     */
    public function update(UpdateOrStoreChargeRequest $request, Charge $charge)
    {
        $charge->update([
            'country' => $request->get('country'),
            'income' => ($request->income / 100),
            'gateway' => $request->get('gateway'),
            'gateway_charge' => ($request->gateway_charge / 100),
        ]);
        return redirect()->route('admin.charges.index')->with(['success' => trans('Charge updated!')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Charge $charge
     * @return RedirectResponse
     */
    public function destroy(Charge $charge)
    {
        $charge->delete();
        return redirect()->route('admin.charges.index')->with(['warning' => trans('Charge deleted!')]);
    }
}
