<?php


namespace App\Charges;


use App\Factories\ChargeFactory;

class PagaloGTCharge implements Charge
{

    private $income;
    private $gatewayCharge;

    const CHARGE_PER_TRANSACTION_IN_LOCAL_CURRENCY = 2;
    const CHARGE_PER_TRANSACTION_IN_DOLLARS = 0.25;
    private $typeOfAmount;

    public function __construct($income, $gatewayCharge, $typeOfAmount)
    {
        $this->income = $income;
        $this->gatewayCharge = $gatewayCharge;
        $this->typeOfAmount = $typeOfAmount;
    }

    public function calculateDeposit()
    {
        $amountWithoutChargePerTransaction = request()->amount - (request()->amount * ($this->gatewayCharge + $this->income));
        if ($this->typeOfAmount === ChargeFactory::LOCAL_CURRENCY_AMOUNT) {
            return $amountWithoutChargePerTransaction - self::CHARGE_PER_TRANSACTION_IN_LOCAL_CURRENCY;
        }
        return $amountWithoutChargePerTransaction - self::CHARGE_PER_TRANSACTION_IN_DOLLARS;
    }

    public function calculateIncome()
    {
        return bcmul(request()->amount, $this->income, 2);
    }
}
