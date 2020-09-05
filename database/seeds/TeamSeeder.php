<?php

use App\Models\Team;
use App\User;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(User::class)->create([
            'name' => 'Otto',
            'email' => 'ofernando@ufm.edu',
            'password' => bcrypt(12345678)
        ]);

        factory(Team::class)->create([
            'name' => 'Fundacion Selva virgen',
            'category' => 'Social',
        ]);

        factory(Team::class)->create([
            'name' => 'Fundacion Guatemalteca de promocion humana',
            'category' => 'Educacion',
        ]);

        factory(Team::class)->create([
            'name' => 'Fundacion GuateDon',
            'category' => 'Educacion',
        ]);

        $teams = Team::all();

        $teams->each(fn($team) => $user->teams()->attach($team));

        $anotherUser = factory(User::class)->create([
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => bcrypt(12345678),
        ]);

        $anotherTeams = factory(Team::class)->times(3)->create();

        $anotherTeams->each(fn($team) => $anotherUser->teams()->attach($team));

    }
}
