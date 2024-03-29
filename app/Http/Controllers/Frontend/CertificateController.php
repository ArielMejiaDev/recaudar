<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Transaction;
use App\Services\DateToStringFormatter;
use App\Services\SEO\TeamPageSeoService;
use App\Services\SEO\TeamProfilePageSeoService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CertificateController extends Controller
{
    public function __invoke(Request $request, Team $team, Transaction $transaction)
    {
        (new TeamProfilePageSeoService)->execute($team);
        $certificateDate = (new DateToStringFormatter)->make($transaction->created_at);
        return view('certificate', compact('team', 'transaction', 'certificateDate'));
    }
}
