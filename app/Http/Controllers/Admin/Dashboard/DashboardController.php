<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Transaction;
use App\Services\LocaleCodeResolver;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
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
            'income' => trans('Income'),
            'status' => trans('Status'),
            'date' => trans('Date'),
            'approved' => trans('Approved'),
            'pending' => trans('Pending'),
            'failed' => trans('Failed'),
            'invite_admin' => trans('Invite Admin'),
        ];
    }

    public function __invoke()
    {
        $query = Transaction::query()
            ->select('income')
            ->whereStatus('approved')
            ->whereMonth('created_at', now()->format('m'));

        $totalIncome = $query->sum('income');
        $newRecurrentPlans = $query->whereType('recurrent')->count();
        $totalIncomeByRecurrence = $query->whereType('recurrent')->sum('income');

        $recentTransactions = Transaction::select(['id', 'name', 'income', 'currency', 'status', 'created_at', 'readable_created_at'])
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        $team = Team::whereName('recaudar')->first();

        return Inertia::render('Admin/Dashboard/Index', [
            'totalIncome' => number_format($totalIncome, 2),
            'newRecurrentPlans' => $newRecurrentPlans,
            'totalIncomeByRecurrence' => number_format($totalIncomeByRecurrence, 2),
            'trans' => $this->trans,
            'localCurrencyCode' => (new LocaleCodeResolver)->getLocaleFrom($team->country)->currencyCode(),
            'recentTransactions' => $recentTransactions,
        ]);
    }
}
