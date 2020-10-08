<?php


namespace App\Strategies;


use App\Models\Plan;
use App\Models\Team;
use Illuminate\Validation\ValidationException;

class PaymentRecurrentStrategy
{
    private string $product;

    /**
     * PaymentRecurrentStrategy constructor.
     * @param String $recurrence
     * @param Team $team
     * @param Plan $plan
     * @throws ValidationException
     */
    public function __construct(String $recurrence, Team $team, Plan $plan)
    {

        if ($plan->title === 'of variable amount' && $team->plans->first()->id !== $plan->id) {
            throw ValidationException::withMessages([
                'transaction' => trans('Transaction Fail, please try again later.')
            ]);
        }

        $product = "Contribution to organization {$team->name} with plan {$plan->title}";
        if($recurrence) {
            $product = "Recurrent contribution to organization {$team->name} with plan {$plan->title}";
        }
        $this->product = $product;
    }

    public function product()
    {
        return $this->product;
    }
}
