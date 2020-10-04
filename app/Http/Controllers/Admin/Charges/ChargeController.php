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
    protected array $trans;

    public function __construct()
    {
        $this->trans = [
            'charges' => trans('Charges'),
            'charge' => trans('Charge'),
            'search' => trans('Search'),
            'create_a_charge' => trans('Create a Charge'),
            'country' => trans('Country'),
            'payment_gateway' => trans('Payment Gateway'),
            'delete' => trans('Delete'),
            'are_you_sure_to_delete_charge_for' => trans('Are you sure to delete charge for'),
            'this_action_will_invalid_this_charge' => trans('This action will invalid this charge.'),
            'in' => trans('in'),
            'income' => trans('Income'),
            'gateway_charge_percentage' => trans('Gateway Charge Percentage'),
            'this_settings_are_used_to_calculate_the_amount_to_collect' => trans('This settings are used to calculate the amount to collect.'),
            'charge_details' => trans('Charge Details')
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
            'trans' => $this->trans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Admin/Charge/Create', [
            'trans' => $this->trans,
        ]);
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
        return redirect()->route('admin.charges.index')->with(['success' => trans('Charge') . ' ' . trans('Created')]);
    }

    /**
     * Show the specified resource.
     *
     * @param Charge $charge
     * @return Response
     */
    public function show(Charge $charge)
    {
        return Inertia::render('Admin/Charge/Show', [
            'charge' => $charge,
            'trans' => $this->trans,
        ]);
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
        return redirect()->route('admin.charges.index')->with(['warning' => trans('Charge') . ' ' . trans('Deleted')]);
    }
}
