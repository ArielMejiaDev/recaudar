<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Team;
use App\Models\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'team_id' => factory(Team::class),
        'plan_id' => factory(\App\Models\Plan::class),
        'charge_id' => factory(\App\Models\Charge::class),
        'name' => $faker->firstName,
        'email' => $faker->email,
        'currency' => collect(['local', 'dollars'])->random(),
        'amount' => $amount = $faker->numberBetween(100, 500),
        'type' => collect(['recurrent', 'single'])->random(),
        'amount_to_deposit' => $amount * 0.92,
        'income' => $amount * 0.025,
        'status' => collect(['checked', 'pending'])->random(),
    ];
});
