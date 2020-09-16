<?php

use App\Models\Plan;
use App\Models\Team;
use Illuminate\Database\Seeder;

class AttachPlansToTeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get groups of 10 plans and loop into a team, 3 teams to loop and attach plans to teams team->plans()->attach
        $plans = Plan::all();
        $plans = $plans->chunk(10);

        $plans->get(0)->each(fn($plan) => $plan->teams()->attach(Team::find(2)));

        $plans->get(1)->each(fn($plan) => $plan->teams()->attach(Team::find(3)));

        $plans->get(2)->each(fn($plan) => $plan->teams()->attach(Team::find(4)));
    }
}
