<?php

namespace App\Http\Controllers\Frontend;

use App\Factories\ChargeFactory;
use App\Http\Controllers\Controller;
use App\Mail\DonationThanks;
use App\Models\Charge;
use App\Models\Plan;
use App\Models\Team;
use App\Services\LocaleCodeResolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Mail;
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
            'currency' => ['required', Rule::in(['GTQ', 'USD'])],
            'amount' => ['required', 'numeric', 'min:25'],
            'recurrence' => ['boolean'],
            'deviceFingerprintID' => ['required', 'min:13']
        ]);

        if ($plan->title === 'of variable amount' && $team->plans->first()->id !== $plan->id) {
            throw ValidationException::withMessages([
                'transaction' => trans('Transaction Fail, please try again later.')
            ]);
        }

        $splitName = explode(' ', $request->name, 2);
        $firstname = $splitName[0];
        $lastname = !empty($splitName[1]) ? $splitName[1] : '';

        $product = "Contribution to organization {$team->name} with plan {$plan->title}";
        if($request->recurrence) {
            $product = "Recurrent contribution to organization {$team->name} with plan {$plan->title}";
        }

        $response = PagaloGT::add(1, $product, $request->amount)
            ->setClient($firstname, $lastname, $request->email)
            ->withTestCard(Str::of($request->name)->slug()->replace('-', ''))
            ->withTestCredentials()
            ->pay();

        if(isset($response->json()['decision']) && $response->json()['decision'] === 'ACCEPT') {

            $transaction = $this->createTransaction($request, $team, $plan);

            Mail::to($request->email)->send(new DonationThanks($transaction->id, $team));

            return response()->json(['redirect' => route('certificate', ['team' => $team, 'transaction' => $transaction])]);
        }

        $this->createTransaction($request, $team, $plan, 'failed');

        throw ValidationException::withMessages([
            'transaction' => trans('Transaction Fail, please try again later.')
        ]);

    }

    /**
     * @param Request $request
     * @param Team $team
     * @param Plan $plan
     * @param string $status
     * @return Model
     */
    public function createTransaction(Request $request, Team $team, Plan $plan, $status = 'approved')
    {
        $charge = (new ChargeFactory)->make($team);

        // In the future by adding dollars transactions to teams on any country
        // // it will first validate if payment is in dollars else search the country and add the currency code of team country
        $currencyCode = (new LocaleCodeResolver)->getLocaleFrom($team->country)->currencyCode();

        return $team->transactions()->create([
            'plan_id' => $plan->id,
            'charge_id' => Charge::whereCountry($team->country)->firstOrFail()->id,
            'name' => $request->name,
            'email' => $request->email,
            'currency' => $currencyCode,
            'amount' => $request->amount,
            'type' => $request->recurrence ? 'recurrent' : 'single',
            'amount_to_deposit' => $charge->calculateDeposit(),
            'income' => $charge->calculateIncome(),
            'status' => $status,
        ]);
    }
}
