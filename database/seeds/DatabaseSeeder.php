<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             TeamSeeder::class,
             UserSeeder::class,
             PlanSeeder::class,
             AttachUsersToTeamsSeeder::class,
             AttachPlansToTeamsSeeder::class,
             TestingAdminsSeeder::class,
             ChargeSeeder::class,
             TransactionSeeder::class,
         ]);
    }
}
