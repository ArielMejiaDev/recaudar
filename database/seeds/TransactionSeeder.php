<?php

use App\Models\Team;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team = Team::find(2);
        $plan = $team->plans->first();
        $charge = \App\Models\Charge::whereCountry($team->country)->first();
        factory(\App\Models\Transaction::class)->times(10)->create([
            'team_id' => $team->id,
            'plan_id' => $plan->id,
            'charge_id' => $charge->id
        ]);
    }
}
