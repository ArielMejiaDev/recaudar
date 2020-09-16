<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Taylor Otwell',
            'email' => 'taylor@laravel.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Mohammed Said',
            'email' => 'mohammed@laravel.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Dries Vints',
            'email' => 'dries@laravel.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'James Brooks',
            'email' => 'jamesbrooks@laravel.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Graham Campbell',
            'email' => 'graham@laravel.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Nuno Maduro',
            'email' => 'nuno@laravel.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Adam Wathan',
            'email' => 'adam@tailwindcss.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Caleb Porzio',
            'email' => 'Caleb@livewire.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Jonathan Reinik',
            'email' => 'jonathan@inertiajs.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Freek van der Herten',
            'email' => 'freak@spatie.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Marcel Pociot',
            'email' => 'marcel@beyondcode.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Matt Stauffer',
            'email' => 'matt@tighten.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Eric Barnes',
            'email' => 'eric@laravelnews.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Paul Redmond',
            'email' => 'paul@laravelnews.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Michael Dyrenda',
            'email' => 'michael@laravelnews.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Jake Bennet',
            'email' => 'jake@laravelnews.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Povilas Korop',
            'email' => 'povilas@laraveldaily.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Jeffrey Way',
            'email' => 'jeffrey@laracast.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Andre Madarang',
            'email' => 'andre@laracast.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Christoph Rumpel',
            'email' => 'christoph@lca.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Alex Garrett-Smith',
            'email' => 'alex@codecourse.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Jess Archer',
            'email' => 'alex@basecode.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Jason McCreary',
            'email' => 'jmac@laravelshift.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Caneco',
            'email' => 'caneco@laraveleu.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Victor Gonzalez',
            'email' => 'victor@coderstape.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Jani Gyllenberg',
            'email' => 'jani@foreigndevs.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Miguel Pietrafita',
            'email' => 'miguel@sitesauce.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Joseph Silber',
            'email' => 'joseph@silber.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Chris Fidao',
            'email' => 'chris@serversforhackers.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Steve Schoeger',
            'email' => 'steve@tailwindcss.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Bobby Bouwmann',
            'email' => 'bobby@laravelsecrets.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Stefan Bauer',
            'email' => 'stefan@laravelsecrets.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Sarthak Shrivastava',
            'email' => 'sarthak@indepthlaravel.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Colin Decarlo',
            'email' => 'colin@vehikl.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Tim MacDonald',
            'email' => 'tim@laraconau.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Samantha Geitz',
            'email' => 'samantha@blockchainandyou.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Wes Bos',
            'email' => 'wes@bos.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Rachel Andrew',
            'email' => 'rachel@csswg.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Nick Canzoneri',
            'email' => 'nick@postmark.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Evan You',
            'email' => 'evan@vuejs.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Justin Jackson',
            'email' => 'justin@transistorfm.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Samuel Štancl',
            'email' => 'samuel@tenancy.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Duilio Palacios',
            'email' => 'duilio@styde.net',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Clemir Rincon',
            'email' => 'clemir@styde.net',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Jorge',
            'email' => 'jorge@aprendible.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Herminio Herrera',
            'email' => 'herminio@laraveles.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Josel Fonseca',
            'email' => 'josel@laraveles.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Sergio Ojeda',
            'email' => 'sergio@laraveles.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Matias Echazarreta',
            'email' => 'matias@laraveltip.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Victor Yoalli',
            'email' => 'victor@yoalli.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Juan Megon',
            'email' => 'juan@megon.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Ariel Mejia',
            'email' => 'arielmejiadev@gmail.com',
            'password' => bcrypt(12345678),
        ]);

        factory(User::class)->create([
            'name'  => 'Otto Fernando',
            'email' => 'ofernando@ufm.edu',
            'password' => bcrypt(12345678),
        ]);
    }
}
