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
            'description' => 'Somos una fundación, preocupada por los indices de desnutrición que existen en Guatemala. Nuestro objetivo es que con nuestro programa Adopta un Vaso se logre generar un impacto positivo en este tema y de esta forma poder aportar de nuestra parte para combatir este problema que afecta a millones de niños Guatemaltecos. Programas de seguridad alimentaria y educación ambiental.',
            'public' => 'Personas interesadas en seguridad alimentaria y el medio ambiente',
            'category' => 'Ambientales',
            'beneficiaries' => 25,
        ]);

        factory(Team::class)->create([
            'name' => 'Fundacion Guatemalteca de promocion humana',
            'slug' => 'fundacion-guatemalteca-de-promocion-humana',
            'category' => 'Educacion',
            'description' => 'Centro Educativo San Judas Tadeo es un proyecto social sin fines de lucro, bajo el apoyo de la Parroquia San Judas Tadeo y Fundación Guatemalteca de Promoción Humana con más de 25 años en el país. El objetivo principal es brindar educación de calidad a las comunidades más necesitadas del sector de Santa Fe y La Libertad principalmente. Formamos niños, niñas y jóvenes con educación académica de calidad, basada en valores Agustinianos.',
            'beneficiaries' => 570,
            'public' => 'Organización Educativa'
        ]);

        factory(Team::class)->create([
            'name' => 'Fundacion GuateDon',
            'slug' => 'fundacion-guatedon',
            'category' => 'Educacion',
            'description' => 'GuateDon surgió como una organización para servir a las familias más afectadas por el COVID-19. Somos un pequeño equipo de guatemaltecos comprometidos con una misión: Ayudar a nuestro país en estos momentos de crisis.',
            'public' => 'Familias más afectadas por el covid 19.',
            'impact' => 'Somos una organización para servir a las familias más afectadas por el COVID-19.',
            'beneficiaries' => 200,
        ]);

    }
}
