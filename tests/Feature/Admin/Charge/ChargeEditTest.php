<?php

namespace Tests\Feature\Admin\Charge;

use App\Models\Charge;
use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChargeEditTest extends TestCase
{
    use RefreshDatabase;
    /**@test */
    public function test_guests_cannot_access_to_admin_charge_edit()
    {
        $charge = factory(Charge::class)->create();
        session()->setPreviousUrl('/login');
        $response = $this->get(route('admin.charges.edit', ['charge' => $charge]));
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_auth_users_cannot_access_to_admin_charge_edit()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $charge = factory(Charge::class)->create();
        session()->setPreviousUrl('/login');
        $response = $this->get(route('admin.charges.edit', ['charge' => $charge]));
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_team_members_cannot_access_to_admin_charge_edit()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        $this->actingAs($user);
        $charge = factory(Charge::class)->create();
        session()->setPreviousUrl('/login');
        $response = $this->get(route('admin.charges.edit', ['charge' => $charge]));
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_app_admins_can_access_to_admin_charge_edit()
    {
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        $this->actingAs($user);
        $charge = factory(Charge::class)->create();
        $response = $this->get(route('admin.charges.edit', ['charge' => $charge]));
        $response->assertOk();
    }
}
