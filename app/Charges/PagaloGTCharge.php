<?php


namespace App\Charges;


use App\Factories\ChargeFactory;

class PagaloGTCharge implements Charge
{

    private $incomeCharge;
    private $gatewayCharge;

    const CHARGE_PER_TRANSACTION_IN_LOCAL_CURRENCY = 2;
    const CHARGE_PER_TRANSACTION_IN_DOLLARS = 0.25;
    private $typeOfAmount;

    public function __construct($incomeCharge, $gatewayCharge, $typeOfAmount)
    {
        $this->incomeCharge = $incomeCharge;
        $this->gatewayCharge = $gatewayCharge;
        $this->typeOfAmount = $typeOfAmount;
    }

    public function calculateDeposit()
    {
        $amountWithoutChargePerTransaction = request()->amount - (request()->amount * ($this->gatewayCharge + $this->incomeCharge));
        if ($this->typeOfAmount === ChargeFactory::LOCAL_CURRENCY_AMOUNT) {
            return $amountWithoutChargePerTransaction - self::CHARGE_PER_TRANSACTION_IN_LOCAL_CURRENCY;
        }
        return $amountWithoutChargePerTransaction - self::CHARGE_PER_TRANSACTION_IN_DOLLARS;
    }

    public function calculateIncome()
    {
        return bcmul(request()->amount, $this->incomeCharge, 2);
    }
}
