<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Plan;
use Faker\Generator as Faker;

$factory->define(Plan::class, function (Faker $faker) {
    return [
        'title' => $faker->text(5),
        'info' => $faker->text,
        'amount' => $faker->numberBetween(100, 500),
        'currency' => $faker->currencyCode,
        'banner' => $faker->imageUrl(),
    ];
});
