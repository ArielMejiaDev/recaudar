<?php

namespace App\Http\Controllers\Admin\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
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
            'organization' => trans('Organization'),
            'income' => trans('Income'),
            'amount' => trans('Amount'),
            'amount_to_deposit' => trans('Amount To Deposit'),
            'status' => trans('Status'),
            'type' => trans('Type'),
            'active' => trans('Active'),
            'date' => trans('Date'),
            'approved' => trans('Approved'),
            'pending' => trans('Pending'),
            'failed' => trans('Failed'),
            'single' => trans('Single'),
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
        Gate::authorize('manage-transactions');

        $transactions = Transaction::with(['team' => fn($query) => $query->select(['id', 'name'])])
            ->select([
                'id', 'amount', 'income', 'currency', 'status', 'type', 'reviewed', 'created_at', 'team_id'
            ])
            ->orderByDesc('id')
            ->paginate(5);

        if($request->has('search')) {

            $searchFilters = collect([
                'Approved' => 'approved',
                'Pending' => 'pending',
                'Failed' => 'failed',
                'Checked' => 'checked',
                'Recurrent' => 'recurrent',
                'Single' => 'single'
            ]);

            $searchFilters->each(function ($item, $key) use($request) {
                if(Str::contains(Str::lower(trans($key)), Str::lower($request->search))) {
                    $request->search = $item;
                }
            });

            $transactions = Transaction::with(['team' => fn($query) => $query->select(['id', 'name'])])
                ->select([
                    'id', 'amount', 'income', 'currency', 'status', 'type', 'reviewed', 'created_at', 'team_id'
                ])->where(function($query) use($request) {
                    $query->where('income', 'LIKE', "%{$request->search}%")
                        ->orWhere('amount_to_deposit', 'LIKE', "%{$request->search}%")
                        ->orWhere('status', 'LIKE', "%{$request->search}%")
                        ->orWhere('reviewed', 'LIKE', "%{$request->search}%")
                        ->orWhere('type', 'LIKE', "%{$request->search}%")
                        ->orWhereHas('team', function(Builder $query) use($request) {
                            $query->where('name', 'LIKE', "%{$request->search}%");
                        })
                    ;
                })
                ->orderByDesc('id')
                ->paginate(5);
        }

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
        Gate::authorize('manage-transactions');
        $transaction = $transaction->load('team')->only(['id', 'name', 'email', 'currency', 'amount', 'amount_to_deposit', 'income', 'type', 'status', 'reviewed', 'created_at', 'readable_created_at', 'team']);
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
        Gate::authorize('manage-transactions');

        $transaction->update([
            'reviewed' => $transaction->reviewed === 'pending' ? 'checked' : 'pending',
        ]);
        return redirect()->route('admin.transactions.index')->with(['success' => trans('Transaction updated!')]);
    }
}
