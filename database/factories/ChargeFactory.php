<?php

/** @var Factory $factory */

use App\Models\Charge;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Charge::class, function (Faker $faker) {
    return [
        'country' => collect(['Guatemala', 'El Salvador', 'Honduras', 'Panama', 'Costa Rica'])->random(),
        'income_charge' => collect([2.5, 3.0, 3.5])->random(),
        'gateway' => collect(['pagalogt', 'pagadito', 'paypal', 'bac', 'payu'])->random(),
        'gateway_charge' => collect([5.0, 5.5, 6.0])->random(),
    ];
});
