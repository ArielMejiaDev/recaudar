<?php

namespace App\Http\Controllers\Team\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Transaction;
use App\Services\LocaleCodeResolver;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class TransactionController extends Controller
{

    private array $trans;

    public function __construct()
    {
        $this->trans = [
            'by' => trans('By'),
            'amount' => trans('Amount'),
            'date' => trans('Date'),
            'status' => trans('Status'),
            'pending' => trans('Pending'),
            'approved' => trans('Approved'),
            'failed' => trans('Failed'),
            'email' => trans('Email'),
            'type' => trans('Type'),
            'transaction_details' => trans('Transaction details'),
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @param Team $team
     * @return Response
     */
    public function index(Request $request, Team $team)
    {
        $transactions = $team->transactions()->select(['id', 'name', 'amount_to_deposit', 'status', 'created_at', 'currency'])->paginate();

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

            if(
                Str::contains(
                    Str::lower(trans('Failed')),
                    Str::lower($request->search)
                )
            ) {
                $request->search = 'failed';
            }

            // filter by dates
            // $date = Carbon::createFromFormat('d/m/Y', $request->search);
            // $date->format('Y-m-d');

            $transactions = $team->transactions()->where(function($query) use($request) {
                return $query->where('name', 'LIKE', "%{$request->search}%")
                    ->orWhere('email', 'LIKE', "%{$request->search}%")
                    ->orWhere('currency', 'LIKE', "%{$request->search}%")
                    ->orWhere('amount_to_deposit', 'LIKE', "%{$request->search}%")
                    ->orWhere('status', 'LIKE', "%{$request->search}%")
                    ->orWhere('created_at', 'LIKE', "%{$request->search}%");
            })->select(['id', 'name', 'amount_to_deposit', 'status', 'created_at', 'currency'])->paginate();
        }

        return Inertia::render('Teams/Transaction/Index', [
            'team' => $team->only(['id', 'slug']),
            'transactions' => $transactions,
            'filters' => $request->all('search'),
            'trans' => $this->trans,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Team $team
     * @param Transaction $transaction
     * @return Response
     */
    public function show(Team $team, Transaction $transaction)
    {
        $country = $transaction->currency === 'dollars' ? 'United States' : 'Guatemala';
        $locale = (new LocaleCodeResolver)->getLocaleFrom($country);

        return Inertia::render('Teams/Transaction/Show', [
            'transaction' => $transaction->only(['id', 'name', 'email', 'status', 'currency', 'created_at', 'readable_created_at', 'amount_to_deposit', 'type']),
            'team' => $team->only(['id', 'slug']),
            'locale' => [
                'country' => $locale->countryCode(),
                'currency' => $locale->currencyCode(),
            ],
            'trans' => $this->trans,
        ]);
    }

}
