<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Models\Plan;
use App\Models\Team;
use App\Models\Transaction;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use PagaloGT;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __invoke(Request $request, Team $team, Plan $plan)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'min:5'],
            'card' => ['required', 'min:12'],
            'date' => ['required', 'min:4'],
            'cvc' => ['required', 'min:3'],
            'currency' => ['required'],
            'amount' => ['required', 'numeric', 'min:25'],
            'recurrence' => ['boolean'],
        ]);

        $splitName = explode(' ', $request->name, 2);
        $firstname = $splitName[0];
        $lastname = !empty($splitName[1]) ? $splitName[1] : '';

        $product = 'Aporte a la fundacion ' . $team->name . ' plan ' . $plan->title;
        if($request->recurrence) {
            $product = 'Aporte recurrente a la fundacion ' . $team->name . ' plan ' . $plan->title;
        }

        $response = PagaloGT::add(1, $product, $request->amount)
            ->setClient($firstname, $lastname, $request->email)
            ->withTestCard($request->name)
            ->withTestCredentials()
            ->pay();

        if($response->successful()) {

            $team->transactions()->create([
                'plan_id' => $plan->id,
                'charge_id' => Charge::whereCountry($team->country)->firstOrFail()->id,
            ]);

            return response()->json(['redirect' => route('profile-page', $team)]);
        }

        throw ValidationException::withMessages([
            'transaction' => trans('Transaction Fail, please try again later.')
        ]);

    }
}
