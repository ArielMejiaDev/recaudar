<?php

use App\Models\Charge;
use Illuminate\Database\Seeder;

class ChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Charge::class)->times(10)->create();

        factory(Charge::class)->create([
            'country' => 'Guatemala',
            'income' => 0.025,
            'gateway' => 'pagalogt',
            'gateway_charge' => 0.055,
        ]);
    }
}
