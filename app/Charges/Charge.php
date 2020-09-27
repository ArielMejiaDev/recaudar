<?php


namespace App\Charges;


interface Charge
{
    public function calculateIncome();

    public function calculateDeposit();
}
