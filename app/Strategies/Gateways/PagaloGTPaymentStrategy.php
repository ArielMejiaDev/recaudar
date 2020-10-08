<?php


namespace App\Strategies\Gateways;


use App\Factories\ChargeFactory;
use App\Mail\DonationThanks;
use App\Models\Charge;
use App\Models\Plan;
use App\Models\Team;
use PagaloGT;
use App\Services\LocaleCodeResolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Mail;

class PagaloGTPaymentStrategy
{
    private $response;

    public function executePayment(int $quantity, string $description, $price, string $firstname, string $lastname, $email, string $card, string $month, string $year, string $cvc)
    {
        if (app()->environment('local') || app()->environment('testing')) {
             $this->response = PagaloGT::add($quantity, $description, $price)
                ->setClient($firstname, $lastname, $email)
                ->withTestCard(Str::of($firstname . ' ' . $lastname)->slug()->replace('-', ''))
                ->withTestCredentials()
                ->pay();
             return $this;
        }
        $this->response = PagaloGT::add($quantity, $description, $price)
        ->setClient($firstname, $lastname, $email)
        ->setCard($firstname . ' ' .$lastname, $card, $month, $year, $cvc)
        ->pay();
        return $this;
    }

    /**
     * @param $request
     * @param $team
     * @param $plan
     * @return JsonResponse
     * @throws ValidationException
     */
    public function processTransaction($request, $team, $plan)
    {
        if($this->transactionIsSuccessful()) {
            $transaction = $this->createTransaction($request, $team, $plan);
            Mail::to($request->email)->send(new DonationThanks($transaction->id, $team));
            return response()->json(['redirect' => route('certificate', ['team' => $team, 'transaction' => $transaction])]);
        }

        $this->createTransaction($request, $team, $plan, 'failed');
        throw ValidationException::withMessages([
            'transaction' => trans('Transaction Fail, please try again later.')
        ]);
    }

    public function transactionIsSuccessful()
    {
        return isset($this->response->json()['decision']) && $this->response->json()['decision'] === 'ACCEPT';
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
