<?php

use App\Models\Team;
use Illuminate\Database\Seeder;

class AttachUsersToTeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get groups of 16 users and loop every group and assing it to a team
        $users = \App\User::all();

        $users = $users->chunk(16);

        $users->get(0)->each(fn($user) => $user->teams()->attach(Team::first()));

        $users->get(1)->each(fn($user) => $user->teams()->attach(Team::find(2)));

        $users->get(2)->each(fn($user) => $user->teams()->attach(Team::find(3)));
    }
}
