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
    ];
});
