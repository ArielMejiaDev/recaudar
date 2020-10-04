<?php

namespace App\Http\Controllers\Admin\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class TransactionsController extends Controller
{
    protected array $trans;

    public function __construct()
    {
        $this->trans = [
            'transactions' => trans('Transactions'),
            'by' => trans('By'),
            'email' =>  trans('Email'),
            'search' => trans('Search'),
            'amount' => trans('Amount'),
            'status' => trans('Status'),
            'type' => trans('Type'),
            'active' => trans('Active'),
            'date' => trans('Date'),
            'approved' => trans('Approved'),
            'pending' => trans('Pending'),
            'failed' => trans('Failed'),
            'single' => trans('Unico'),
            'recurrent' => trans('Recurrent'),
            'reviewed' => trans('Reviewed'),
            'checked' => trans('Checked'),
            'transaction_details' => trans('Transaction Details'),
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $transactions = Transaction::orderByDesc('id')->paginate();
        return Inertia::render('Admin/Transactions/Index', [
            'transactions' => $transactions,
            'filters' => $request->only('search'),
            'trans' => $this->trans,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return \Inertia\Response
     */
    public function show(Transaction $transaction)
    {
        $transaction = $transaction->only(['id', 'name', 'email', 'currency', 'amount', 'type', 'status', 'reviewed', 'created_at', 'readable_created_at']);
        return Inertia::render('Admin/Transactions/Show', [
            'transaction' => $transaction,
            'trans' => $this->trans,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Transaction $transaction
     * @return RedirectResponse
     */
    public function update(Request $request, Transaction $transaction)
    {
        $transaction->update([
            'reviewed' => $transaction->reviewed === 'pending' ? 'checked' : 'pending',
        ]);
        return redirect()->route('admin.transactions.index')->with(['success' => trans('Transaction updated!')]);
    }
}
