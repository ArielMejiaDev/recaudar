<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Team;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->company,
        'status' => 'approved',
        'slug' => \Illuminate\Support\Str::slug($name),
        'category' => $faker->text(10),
        'logo' => $faker->imageUrl(),
        'banner' => $faker->imageUrl(),
        'description' => $faker->text(30),
        'public' => $faker->text(20),
        'beneficiaries' => $faker->numberBetween(100, 500),
        'impact' => $faker->text(50),
        'legal_representative' => $faker->name(),
        'tax_number' => $faker->uuid,
        'office_address' => $faker->address,
        'use_of_funds' => $faker->text(50),
        'contact' => $faker->name(),
        'contact_phone' => $faker->phoneNumber,
        'contact_email' => $faker->email,
        'facebook_account' => $faker->url,
        'twitter_account' => $faker->url,
        'instagram_account' => $faker->url,
        'theme' => 'classic',
        'account_number' => $faker->bankAccountNumber,
        'bank' => $faker->company,
        'country' => collect(['Guatemala', 'El Salvador', 'Honduras', 'Panama', 'Costa Rica'])->random(),
    ];
});
