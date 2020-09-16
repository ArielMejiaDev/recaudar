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
        factory(Team::class)->create([
            'name' => 'recaudar',
            'slug' => 'recaudar',
            'category' => 'Admin',
            'status' => 'approved',
        ]);

        factory(Team::class)->create([
            'name' => 'Fundacion Selva virgen',
            'slug' => 'fundacion-selva-virgen',
            'category' => 'Social',
        ]);

        factory(Team::class)->create([
            'name' => 'Fundacion Guatemalteca de promocion humana',
            'slug' => 'fundacion-guatemalteca-de-promocion-humana',
            'category' => 'Educacion',
        ]);

        factory(Team::class)->create([
            'name' => 'Fundacion GuateDon',
            'slug' => 'fundacion-guatedon',
            'category' => 'Educacion',
        ]);

    }
}
