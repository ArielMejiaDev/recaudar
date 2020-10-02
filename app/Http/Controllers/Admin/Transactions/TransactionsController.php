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
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $transactions = Transaction::orderByDesc('id')->paginate();
        return Inertia::render('Admin/Transactions/Index', [
            'transactions' => $transactions,
            'filters' => $request->only('search'),
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
        return Inertia::render('Admin/Transactions/Show', compact('transaction'));
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
