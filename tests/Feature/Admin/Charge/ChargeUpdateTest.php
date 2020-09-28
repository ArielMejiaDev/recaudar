<?php

namespace Tests\Feature\Admin\Charge;

use App\Models\Charge;
use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChargeUpdateTest extends TestCase
{
    use RefreshDatabase;
    /**@test */
    public function test_guests_cannot_update_a_charge()
    {
        $charge = factory(Charge::class)->create();
        session()->setPreviousUrl('/login');
        $response = $this->put(route('admin.charges.update', ['charge' => $charge]), [
            'country' => 'Guatemala',
            'country_charge' => 3.0,
            'payment_gateway' => 'pagalogt',
            'payment_gateway_charge' => 2.0
        ]);
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_auth_users_cannot_update_a_charge()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $charge = factory(Charge::class)->create();
        session()->setPreviousUrl('/login');
        $response = $this->put(route('admin.charges.update', ['charge' => $charge]), [
            'country' => 'Guatemala',
            'country_charge' => 3.0,
            'payment_gateway' => 'pagalogt',
            'payment_gateway_charge' => 2.0
        ]);
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_team_members_cannot_update_a_charge()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        $this->actingAs($user);
        $charge = factory(Charge::class)->create();
        session()->setPreviousUrl('/login');
        $response = $this->put(route('admin.charges.update', ['charge' => $charge]), [
            'country' => 'Guatemala',
            'country_charge' => 3.0,
            'payment_gateway' => 'pagalogt',
            'payment_gateway_charge' => 2.0
        ]);
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_app_admins_cannot_update_a_charge_with_invalid_data()
    {
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        $this->actingAs($user);

        $charge = factory(Charge::class)->create();

        session()->setPreviousUrl('/login');

        $response = $this->put(route('admin.charges.update', ['charge' => $charge]), [
            'country' => 'Any',
            'income' => 'lorem',
            'gateway' => '',
            'gateway_charge' => 'ipsum'
        ]);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['country', 'income', 'gateway', 'gateway_charge']);
        $charge->refresh();
        $this->assertNotEquals('Any', $charge->country);
    }
    /**@test */
    public function test_app_admins_can_update_a_charge()
    {
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        $this->actingAs($user);

        $charge = factory(Charge::class)->create();

        session()->setPreviousUrl('/login');

        $response = $this->put(route('admin.charges.update', ['charge' => $charge]), [
            'country' => 'Guatemala',
            'income' => 3,
            'gateway' => 'pagalogt',
            'gateway_charge' => 2
        ]);
        $response->assertRedirect();
        $charge->refresh();
        $this->assertEquals('Guatemala', $charge->country);
    }
}
