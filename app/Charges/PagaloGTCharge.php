<?php


namespace App\Charges;


use App\Factories\ChargeFactory;

class PagaloGTCharge implements Charge
{

    private $incomeCharge;
    private $gatewayCharge;
    private string $typeOfAmount;

    const CHARGE_PER_TRANSACTION_IN_LOCAL_CURRENCY = 2;
    const CHARGE_PER_TRANSACTION_IN_DOLLARS = 0.25;

    public function __construct($incomeCharge, $gatewayCharge, string $typeOfAmount)
    {
        $this->incomeCharge = $incomeCharge;
        $this->gatewayCharge = $gatewayCharge;
        $this->typeOfAmount = $typeOfAmount;
    }

    public function calculateDeposit()
    {
        $pagaloPayment = request()->amount * ($this->gatewayCharge / 100);
        $recaudarPayment = request()->amount * ($this->incomeCharge / 100);

        if ($this->typeOfAmount === ChargeFactory::LOCAL_CURRENCY_AMOUNT) {
            $discount = $pagaloPayment + $recaudarPayment + self::CHARGE_PER_TRANSACTION_IN_LOCAL_CURRENCY;
            return request()->amount - $discount;
        }
        $discount = $pagaloPayment + $recaudarPayment + self::CHARGE_PER_TRANSACTION_IN_DOLLARS;
        return request()->amount - $discount;
    }

    public function calculateIncome()
    {
        return request()->amount * ($this->incomeCharge / 100);
    }
}
