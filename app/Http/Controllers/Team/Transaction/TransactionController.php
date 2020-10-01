<?php

namespace App\Http\Controllers\Team\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Transaction;
use App\Services\LocaleCodeResolver;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Team $team
     * @return Response
     */
    public function index(Request $request, Team $team)
    {
        $transactions = $team->transactions()->select(['id', 'name', 'amount_to_deposit', 'status', 'readable_created_at', 'created_at', 'currency'])->paginate();

        if($request->has('search')) {

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
            })->select(['id', 'name', 'amount_to_deposit', 'status', 'readable_created_at', 'created_at', 'currency'])->paginate();
        }

        return Inertia::render('Teams/Transaction/Index', [
            'team' => $team->only(['id', 'slug']),
            'transactions' => $transactions,
            'filters' => $request->all('search'),
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
            ]
        ]);
    }

}
