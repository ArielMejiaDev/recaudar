<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landing\Payment\PaymentRequest;
use App\Models\Plan;
use App\Models\Team;
use App\Services\CustomerNameResolverService;
use App\Strategies\Gateways\PagaloGTPaymentStrategy;
use App\Strategies\PaymentRecurrentStrategy;

class PaymentController extends Controller
{
    public function __invoke(PaymentRequest $request, Team $team, Plan $plan)
    {
        $customerName = new CustomerNameResolverService($request->get('name'));

        $product = (new PaymentRecurrentStrategy($request->get('recurrence'), $team, $plan))->product();

       return (new PagaloGTPaymentStrategy)
            ->executePayment(
                1,
                $product,
                $request->get('amount'),
                $customerName->firstname(),
                $customerName->lastname(),
                $request->get('email'),
                $request->get('card'),
                $request->get('month'),
                $request->get('year'),
                $request->get('cvc'),
            )->processTransaction($request, $team, $plan);
    }
}
