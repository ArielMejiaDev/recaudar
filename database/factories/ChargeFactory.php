<?php

/** @var Factory $factory */

use App\Models\Charge;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Charge::class, function (Faker $faker) {
    return [
        'country' => collect(['Guatemala', 'El Salvador', 'Honduras', 'Panama', 'Costa Rica'])->random(),
        'income' => collect([00.20, 00.30, 00.40])->random(),
        'gateway' => collect(['pagalogt', 'pagadito', 'paypal', 'bac', 'payu'])->random(),
        'gateway_charge' => collect([00.50, 00.60, 00.70])->random(),
    ];
});
