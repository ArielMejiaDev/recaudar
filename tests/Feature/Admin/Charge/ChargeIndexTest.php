<?php

namespace Tests\Feature\Admin\Charge;

use App\Models\Charge;
use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChargeIndexTest extends TestCase
{
    use RefreshDatabase;
    /**@test */
    public function test_guests_cannot_access_to_admin_charge_index()
    {
        $charge = factory(Charge::class)->create();
        session()->setPreviousUrl('/login');
        $response = $this->get(route('admin.charges.index'));
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_auth_users_but_not_team_members_cannot_access_to_admin_charge_index()
    {
        $charge = factory(Charge::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        session()->setPreviousUrl('/');
        $response = $this->get(route('admin.charges.index'));
        $response->assertRedirect();
        $response->assertLocation('/');
    }
    /**@test */
    public function test_team_members_cannot_access_to_admin_charge_index()
    {
        $charge = factory(Charge::class)->create();
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        $this->actingAs($user);
        session()->setPreviousUrl('/');
        $response = $this->get(route('admin.charges.index'));
        $response->assertRedirect();
        $response->assertLocation('/');
    }
    /**@test */
    public function test_app_admins_can_access_to_admin_charge_index()
    {
        factory(Charge::class)->times(5)->create();
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        $this->actingAs($user);
        session()->setPreviousUrl('/');
        $response = $this->get(route('admin.charges.index'));
        $response->assertOk();
        $response->assertPropCount('charges.data', 5);
    }
}
