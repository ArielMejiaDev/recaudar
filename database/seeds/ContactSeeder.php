<?php

use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Contact::class)
            ->times(10)
            ->create(['team_id' => \App\Models\Team::first()->id]);

        factory(\App\Models\Contact::class)
            ->times(10)
            ->create(['team_id' => \App\Models\Team::find(2)->id]);

        factory(\App\Models\Contact::class)
            ->times(10)
            ->create(['team_id' => \App\Models\Team::find(3)->id]);
    }
}
