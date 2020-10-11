<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Transaction;
use App\Services\LocaleCodeResolver;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamDashboardController extends Controller
{

    private array $trans;

    public function __construct()
    {
        $this->trans = [
            'data_of_the_month' => trans('Data of the month.'),
            'total_transactions' => trans('Total Transactions.'),
            'total_income' => trans('Total Income.'),
            'new_recurrent_plans' => trans('New Recurrent Plans.'),
            'recurrent_plans_income' => trans('Recurrent Plans Income.'),
            'recent_transactions' => trans('Recent Transactions.'),
            'by'=> trans('By'),
            'amount' => trans('Amount'),
            'status' => trans('Status'),
            'date' => trans('Date'),
            'approved' => trans('Approved'),
            'pending' => trans('Pending'),
            'failed' => trans('Failed'),
        ];
    }

    public function __invoke(Team $team)
    {
        $query = $team->transactions()->select('amount_to_deposit')->whereStatus('approved')->whereMonth('created_at', now()->format('m'));
        $monthTotalIncome = $query->get()->sum('amount_to_deposit');
        $monthNewRecurrentPlans = $query->whereType('recurrent')->count();
        $monthTotalIncomeRecurrent = $query->whereType('recurrent')->get()->sum('amount_to_deposit');

        $recentTransactions = $team->transactions()
            ->select(['id', 'name', 'amount_to_deposit', 'currency', 'status', 'created_at'])
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return Inertia::render('Teams/Dashboard/Index', [
            'team' => $team->only('name', 'slug'),
            'monthTotalIncome' => number_format($monthTotalIncome, 2),
            'monthTotalIncomeRecurrent' => number_format($monthTotalIncomeRecurrent, 2),
            'monthNewRecurrentPlans' => $monthNewRecurrentPlans,
            'trans' => $this->trans,
            'localCurrencyCode' => (new LocaleCodeResolver)->getLocaleFrom($team->country)->currencyCode(),
            'recentTransactions' => $recentTransactions,
        ]);
    }
}

