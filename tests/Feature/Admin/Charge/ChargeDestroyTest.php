<?php

namespace Tests\Feature\Admin\Charge;

use App\Models\Charge;
use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChargeDestroyTest extends TestCase
{
    use RefreshDatabase;
    /**@test */
    public function test_guests_cannot_delete_a_charge()
    {
        $charge = factory(Charge::class)->create();
        session()->setPreviousUrl('/login');
        $response = $this->delete(route('admin.charges.destroy', ['charge' => $charge]));
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_auth_users_cannot_delete_a_charge()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $charge = factory(Charge::class)->create();
        session()->setPreviousUrl('/login');
        $response = $this->delete(route('admin.charges.destroy', ['charge' => $charge]));
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_team_members_cannot_delete_a_charge()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        $this->actingAs($user);
        $charge = factory(Charge::class)->create();
        session()->setPreviousUrl('/login');
        $response = $this->delete(route('admin.charges.destroy', ['charge' => $charge]));
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_app_admins_cannot_delete_a_charge()
    {
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        $this->actingAs($user);
        $charge = factory(Charge::class)->create();
        session()->setPreviousUrl('/login');
        $response = $this->delete(route('admin.charges.destroy', ['charge' => $charge]));
        $response->assertRedirect();
        $response->assertLocation(route('admin.charges.index'));
        $response->assertSessionHas(['warning']);
        $this->assertEquals(null, Charge::first());
    }
}
