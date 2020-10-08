<?php


namespace App\Strategies\Validations;


use Exception;

class ValidAmountByCountryStrategy
{
    private int $minimiumAmount;
    private int $maximumAmount;

    public function __construct(string $country)
    {
        $minimiumAmount = [
            'Guatemala' => 25,
            'United States' => 4
        ];

        $maximumAmount = [
            'Guatemala' => 2500,
            'United States' => 340,
        ];

        if(!array_key_exists($country, $minimiumAmount) || !array_key_exists($country, $maximumAmount)) {
            throw new Exception('Country is not available');
        }

        $this->minimiumAmount = $minimiumAmount[$country];
        $this->maximumAmount = $maximumAmount[$country];
    }

    public function minimiumAmount()
    {
        return $this->minimiumAmount;
    }

    public function maximumAmount()
    {
        return $this->maximumAmount;
    }
}
