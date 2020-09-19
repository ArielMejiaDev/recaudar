<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Plan;
use Faker\Generator as Faker;

$factory->define(Plan::class, function (Faker $faker) {
    return [
        'title' => $faker->text(5),
        'info' => $faker->text,
        'amount_in_local_currency' => number_format($faker->numberBetween(100, 500), 2),
        'amount_in_dollars' => number_format($faker->numberBetween(100, 500), 2),
        'banner' => $faker->imageUrl(),
    ];
});
