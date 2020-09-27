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
        $charge = Charge::whereCountry($team->country)->orderByDesc('id')->first(['country_charge', 'payment_gateway_charge', 'payment_gateway']);
        // solo son temporales en lo que refactorizo la migracion para colocar nombres mas eloquentes y el factory y tambien el backend de esta seccion
        $incomeCharge = $charge->country_charge;
        $gatewayCharge = $charge->payment_gateway_charge;
        $gatewayname = $charge->payment_gateway;

        $gateways = [
            'pagalogt' => PagaloGTCharge::class,
        ];
        return new $gateways[$gatewayname]($incomeCharge, $gatewayCharge, $this->typeOfAmount);
    }

    public function setLocalCurrencyAmount()
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
