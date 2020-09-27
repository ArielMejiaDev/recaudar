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
            'country_charge' => 0.025,
            'payment_gateway' => 'pagalogt',
            'payment_gateway_charge' => 0.055,
        ]);
    }
}
