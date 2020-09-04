<?php

use App\Models\Role;
use App\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(User::class)->create([
            'name' => 'Ariel Mejia',
            'email' => 'arielmejiadev@gmail.com',
            'password' => bcrypt(12345678),
        ]);

        $adminRole = factory(Role::class)->create([
           'name' => 'admin',
        ]);

        $user->roles()->create(['name' => $adminRole->name]);

        factory(Role::class)->create([
            'name' => 'team_admin',
        ]);

        factory(Role::class)->create([
            'name' => 'team_editor',
        ]);

        factory(Role::class)->create([
            'name' => 'team_member',
        ]);
    }
}
