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
            'country' => 'Guatemala',
        ]);

        $selvaVirgen = factory(Team::class)->create([
            'name' => 'Fundacion Selva virgen',
            'slug' => 'fundacion-selva-virgen',
            'description' => 'Somos una fundación, preocupada por los indices de desnutrición que existen en Guatemala. Nuestro objetivo es que con nuestro programa Adopta un Vaso se logre generar un impacto positivo en este tema y de esta forma poder aportar de nuestra parte para combatir este problema que afecta a millones de niños Guatemaltecos. Programas de seguridad alimentaria y educación ambiental.',
            'public' => 'Personas interesadas en seguridad alimentaria y el medio ambiente',
            'category' => 'Ambientales',
            'beneficiaries' => 25,
            'country' => 'Guatemala',
            'impact' => 'Programas de seguridad alimentaria y educación ambiental',
            'tax_number' => '28213769',
            'legal_representative' => 'ALEJANDRO GABRIEL, JARQUIN KAEHLER',
            'office_address' => '18 calle 3-17 zona 14, Ciudad de Guatemala',
            'use_of_funds' => 'Operar nuestros programas de seguridad alimentaria y educación ambiental. de igual manera para poder sustentar nuestra granja que genera leche para las familias de las aldeas aledañas.',
            'contact' => 'Esteban Ruano',
            'contact_phone' => '47686992',
            'contact_email' => 'informacion@selvavirgen.org',
            'theme' => 'classic',
            'logo' => 'https://recaudar-development.s3.us-east-2.amazonaws.com/teams_logos/fundacion_selva_virgen_logo.png',
            'banner' => 'https://recaudar-development.s3.us-east-2.amazonaws.com/teams_logos/fundacion_selva_virgen_logo.png'
        ]);

//        $selvaVirgen->users()->create([
//            'name' => 'Esteban Ruano',
//            'email' => 'info@mye.gt',
//            'password' => bcrypt(12345678)
//        ]);

        $selvaVirgen->plans()->create([
            'title' => 'APADRINA A UN NIÑO QUE RECIBIRÁ UN VASO DE LECHE DIARIO POR 30 DÍAS',
            'amount_in_local_currency' => 150.00
        ]);

        $selvaVirgen->plans()->create([
            'title' => 'APADRINA A UN NIÑO QUE RECIBIRÁ UN VASO DE LECHE POR 15 DÍAS',
            'amount_in_local_currency' => 80.00
        ]);

        $selvaVirgen->plans()->create([
            'title' => 'APADRINA A UN NIÑO QUE RECIBIRÁ UN VASO DE LECHE POR 5 DÍAS',
            'amount_in_local_currency' => 300.00
        ]);

        $promocionHumana = factory(Team::class)->create([
            'name' => 'Fundacion Guatemalteca de promocion humana',
            'slug' => 'fundacion-guatemalteca-de-promocion-humana',
            'category' => 'Educacion',
            'description' => 'Centro Educativo San Judas Tadeo es un proyecto social sin fines de lucro, bajo el apoyo de la Parroquia San Judas Tadeo y Fundación Guatemalteca de Promoción Humana con más de 25 años en el país. El objetivo principal es brindar educación de calidad a las comunidades más necesitadas del sector de Santa Fe y La Libertad principalmente. Formamos niños, niñas y jóvenes con educación académica de calidad, basada en valores Agustinianos.',
            'beneficiaries' => 570,
            'public' => 'Organización Educativa',
            'country' => 'Guatemala',
            'impact' => 'Brinda educación de calidad a las comunidades vulnerables del sector de Santa Fe y La Libertad.',
            'tax_number' => '9624546',
            'legal_representative' => 'Estuardo Cifuentes',
            'office_address' => '13 Avenida B 26-45 zona 13 Colonia La Libertad',
            'use_of_funds' => 'Becas escolares.',
            'contact' => 'Nancy Pivaral de Barrios.',
            'contact_phone' => '30690057',
            'contact_email' => 'fundacion@sanjudastadeo.edu.gt',
            'theme' => 'classic',
            'logo' => 'https://recaudar-development.s3.us-east-2.amazonaws.com/teams_logos/fundacion_guatemalteca_de_promocion_humana.png',
            'banner' => 'https://recaudar-development.s3.us-east-2.amazonaws.com/teams_logos/fundacion_guatemalteca_de_promocion_humana.png',
        ]);

        $promocionHumana->plans()->create([
            'title' => 'Media beca mensual',
            'info' => 'Con tu aporte estás apoyando con media beca para la educación de un niño. Puedes darle clic a la opción de aporte recurrente.',
            'amount_in_local_currency' => 100.00
        ]);

        $promocionHumana->plans()->create([
            'title' => 'Beca completa mensual.',
            'info' => 'Con tu aporte estás apoyando con una beca completa durante un mes para la educación de un niño. Puedes darle clic a la opción de aporte recurrente.',
            'amount_in_local_currency' => 175.00
        ]);

        $promocionHumana->plans()->create([
            'title' => 'Beca anual',
            'info' => 'Con tu aporte estás apoyando con una beca completa por todo un año para la educación de un niño. Puedes darle clic a la opción de aporte recurrente.',
            'amount_in_local_currency' => 2100.00
        ]);

        $guatedon = factory(Team::class)->create([
            'name' => 'Fundacion GuateDon',
            'slug' => 'fundacion-guatedon',
            'category' => 'Pobreza',
            'description' => 'GuateDon surgió como una organización para servir a las familias más afectadas por el COVID-19. Somos un pequeño equipo de guatemaltecos comprometidos con una misión: Ayudar a nuestro país en estos momentos de crisis.',
            'public' => 'Familias más afectadas por el covid 19.',
            'impact' => 'Somos una organización para servir a las familias más afectadas por el COVID-19.',
            'beneficiaries' => 200,
            'country' => 'Guatemala',
            'tax_number' => 'Esta información no esta disponible en este momento.',
            'legal_representative' => 'Esta información no esta disponible en este momento.',
            'office_address' => '20 calle Guatemala, Guatemala, Guatemala',
            'use_of_funds' => 'Esta información no esta disponible en este momento.',
            'contact' => 'Esta información no esta disponible en este momento.',
            'contact_phone' => 'Esta información no esta disponible en este momento.',
            'contact_email' => 'guatedon.crisis@gmail.com',
            'theme' => 'classic',
            'logo' => 'https://recaudar-development.s3.us-east-2.amazonaws.com/teams_logos/guatedon_logo.jpg',
            'banner' => 'https://recaudar-development.s3.us-east-2.amazonaws.com/teams_logos/guatedon_logo.jpg'
        ]);

        $guatedon->plans()->create([
            'title' => 'Aporte',
            'amount_in_local_currency' => 250.00
        ]);

        $guatedon->plans()->create([
            'title' => 'Aporte',
            'amount_in_local_currency' => 500.00
        ]);

        $guatedon->plans()->create([
            'title' => 'Aporte',
            'amount_in_local_currency' => 750.00
        ]);

    }
}
