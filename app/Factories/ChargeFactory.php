<?php


namespace App\Factories;


use App\Charges\PagaloGTCharge;
use App\Models\Charge;
use App\Models\Team;
use ReflectionClass;

class ChargeFactory
{
    /**
     * @var mixed|string
     */
    private $typeOfAmount;


    const DOLLARS_AMOUNT = 'amount_in_dollars';
    const LOCAL_CURRENCY_AMOUNT = 'amount_in_local_currency';

    /**
     * @param Team $team
     * @return \App\Charges\Charge
     */
    public function make(Team $team)
    {
        if (! $this->typeOfAmount) {
            $this->typeOfAmount = self::LOCAL_CURRENCY_AMOUNT;
        }

        $charge = Charge::whereCountry($team->country)->orderByDesc('id')->first(['income_charge', 'gateway', 'gateway_charge']);

        $gateways = [
            'pagalogt' => PagaloGTCharge::class,
        ];

        return new $gateways[$charge->gateway]($charge->income_charge, $charge->gateway_charge, $this->typeOfAmount);
    }

    public function setAmountInLocalCurrency()
    {
        $this->typeOfAmount = self::LOCAL_CURRENCY_AMOUNT;
        return $this;
    }

    public function setAmountInDollars()
    {
        $this->typeOfAmount = self::DOLLARS_AMOUNT;
        return $this;
    }
}
