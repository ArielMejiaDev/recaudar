<?php

use App\Models\Team;
use App\User;
use Illuminate\Database\Seeder;

class TestingAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::whereEmail('ofernando@ufm.edu')->first()->teams()->attach(Team::first());
    }
}
