<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Charge;
use Faker\Generator as Faker;

$factory->define(Charge::class, function (Faker $faker) {
    return [
        'country' => collect(['Guatemala', 'El Salvador', 'Honduras', 'Panama', 'Costa Rica'])->random(),
        'country_charge' => collect([00.20, 00.30, 00.40])->random(),
        'payment_gateway' => collect(['pagalogt', 'pagadito', 'paypal', 'bac', 'payu'])->random(),
        'payment_gateway_charge' => collect([00.50, 00.60, 00.70])->random(),
    ];
});
