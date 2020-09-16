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
        User::whereEmail('arielmejiadev@gmail.com')->first()->teams()->attach(Team::first(), ['role_name' => 'app_admin']);

        User::whereEmail('ofernando@ufm.edu')->first()->teams()->attach(Team::find(2), ['role_name' => 'team_admin']);
    }
}
