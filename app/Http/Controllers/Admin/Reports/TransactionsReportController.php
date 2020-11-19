<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class TransactionsReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        if ($request->get('team')) {
            $transactions = Team::where('name', $request->get('team'))
                ->first()
                ->transactions();

            if ($request->get('from') && $request->get('to')) {
                $transactions = $transactions->whereBetween('created_at', [
                    $request->get('from'),
                    $request->get('to'),
                ]);
            }

            if ($request->get('status') && $request->get('status') !== 'all') {
                $transactions = $transactions->whereStatus($request->get('status'));
            }
        }

        return Inertia::render('Admin/Reports/TransactionsReport', [
            'teams' => Team::where('name', '!=', 'recaudar')->pluck('name'),
            'transactions' => isset($transactions) ? $transactions->paginate() : null,
            'filters' => $request->only(['team', 'from', 'to', 'status'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return void
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Transaction $transaction
     * @return Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Transaction $transaction
     * @return Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Transaction $transaction
     * @return Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
