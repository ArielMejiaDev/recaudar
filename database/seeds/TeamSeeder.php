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
            'theme' => 'columns',
            'logo' => 'https://recaudar-development.s3.us-east-2.amazonaws.com/development/fundacion_selva_virgen.png',
            'banner' => 'https://images.unsplash.com/photo-1497486751825-1233686d5d80?ixlib=rb-1.2.1&auto=format&fit=crop&w=1301&q=80',
            'facebook_account' => null,
            'twitter_account' => null,
            'instagram_account' => null,
        ]);

        $selvaVirgen->plans()->create([
            'title' => 'APADRINA A UN NIÑO QUE RECIBIRÁ UN VASO DE LECHE DIARIO POR 30 DÍAS',
            'banner' => 'https://images.unsplash.com/photo-1527490087278-9c75be0b8052?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1347&q=80',
            'info' => 'lorem ipsum dolor siet, lorem lorem ipsum dolore, siet lorem ipsum dolore siet.',
            'amount_in_local_currency' => 150.00
        ]);

        $selvaVirgen->plans()->create([
            'title' => 'APADRINA A UN NIÑO QUE RECIBIRÁ UN VASO DE LECHE POR 15 DÍAS',
            'banner' => 'https://images.unsplash.com/photo-1542317785-ae7b6fa20f55?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80',
            'info' => 'lorem ipsum dolor siet, lorem lorem ipsum dolore, siet lorem ipsum dolore siet, lorem dolore.',
            'amount_in_local_currency' => 80.00
        ]);

        $selvaVirgen->plans()->create([
            'title' => 'APADRINA A UN NIÑO QUE RECIBIRÁ UN VASO DE LECHE POR 5 DÍAS',
            'banner' => 'https://images.unsplash.com/photo-1489942986787-cded4ecf962e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1352&q=80',
            'info' => 'lorem ipsum dolor siet, lorem lorem ipsum dolore, siet lorem ipsum dolore siet, lorem ipsum ipsum siet siet, siet lorem ipsum dolore siet, lorem ipsum ipsum siet siet lorem ipsum ipsum siet siet.',
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
            'theme' => 'condensed',
            'logo' => 'https://recaudar-development.s3.us-east-2.amazonaws.com/development/fundacion_guatemalteca_de_promocion_humana.png',
            'banner' => 'https://images.unsplash.com/photo-1560541919-eb5c2da6a5a3?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80',
            'facebook_account' => null,
            'twitter_account' => null,
            'instagram_account' => null,
        ]);

        $promocionHumana->plans()->create([
            'title' => 'Media beca mensual',
            'info' => 'Con tu aporte estás apoyando con media beca para la educación de un niño. Puedes darle clic a la opción de aporte recurrente.',
            'banner' => 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80',
            'amount_in_local_currency' => 100.00
        ]);

        $promocionHumana->plans()->create([
            'title' => 'Beca completa mensual.',
            'info' => 'Con tu aporte estás apoyando con una beca completa durante un mes para la educación de un niño. Puedes darle clic a la opción de aporte recurrente.',
            'banner' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1404&q=80',
            'amount_in_local_currency' => 175.00
        ]);

        $promocionHumana->plans()->create([
            'title' => 'Beca anual',
            'info' => 'Con tu aporte estás apoyando con una beca completa por todo un año para la educación de un niño. Puedes darle clic a la opción de aporte recurrente.',
            'banner' => 'https://images.unsplash.com/photo-1536337005238-94b997371b40?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'amount_in_local_currency' => 2100.00
        ]);

        $guatedon = factory(Team::class)->create([
            'name' => 'Fundación GuateDon',
            'slug' => 'fundacion-guatedon',
            'category' => 'Pobreza',
            'description' => 'GuateDon surgió como una organización para servir a las familias más afectadas por el COVID-19. Somos un pequeño equipo de guatemaltecos comprometidos con una misión: Ayudar a nuestro país en estos momentos de crisis. Somos una organización para servir a las familias más afectadas por el COVID-19.',
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
            'logo' => 'https://recaudar-development.s3.us-east-2.amazonaws.com/development/guatedon.jpg',
            'banner' => 'https://images.unsplash.com/photo-1593113616828-6f22bca04804?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80',
            'facebook_account' => null,
            'twitter_account' => null,
            'instagram_account' => null,
        ]);

        $guatedon->plans()->create([
            'title' => 'Primer tipo de aporte',
            'info' => 'lorem ipsum dolor siet, lorem ipsum dolor siet, lorem lorem ipsum dolor dolor siet.',
            'banner' => 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80',
            'amount_in_local_currency' => 250.00
        ]);

        $guatedon->plans()->create([
            'title' => 'Segundo tipo de aporte',
            'info' => 'lorem ipsum dolor siet, lorem ipsum dolor siet, lorem lorem ipsum dolor.',
            'banner' => 'https://images.unsplash.com/photo-1493767862928-5585c72094f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'amount_in_local_currency' => 500.00
        ]);

        $guatedon->plans()->create([
            'title' => 'Tercer tipo de aporte',
            'info' => 'lorem ipsum dolor siet, lorem ipsum dolor siet.',
            'banner' => 'https://images.unsplash.com/photo-1527822618093-743f3e57977c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'amount_in_local_currency' => 750.00
        ]);

    }
}
