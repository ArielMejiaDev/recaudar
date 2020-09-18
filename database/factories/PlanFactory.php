<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Plan;
use Faker\Generator as Faker;

$factory->define(Plan::class, function (Faker $faker) {
    return [
        'title' => $faker->text(5),
        'info' => $faker->text,
        'amount_in_local_currency' => $faker->numberBetween(100, 500),
        'amount_in_dollars' => $faker->numberBetween(100, 500),
        'banner' => $faker->imageUrl(),
    ];
});
