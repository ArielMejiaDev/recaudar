<?php

namespace Tests\Feature\Admin\Charge;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChargeStoreTest extends TestCase
{
    use RefreshDatabase;
    /**@test */
    public function test_guests_cannot_store_a_charge()
    {
        session()->setPreviousUrl('/login');
        $response = $this->post(route('admin.charges.store'), [
            'country' => 'Guatemala',
            'country_charge' => 3.0,
            'payment_gateway' => 'pagalogt',
            'payment_gateway_charge' => 5.0,
        ]);
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_auth_users_cannot_store_a_charge()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        session()->setPreviousUrl('/login');
        $response = $this->post(route('admin.charges.store'), [
            'country' => 'Guatemala',
            'country_charge' => 3.0,
            'payment_gateway' => 'pagalogt',
            'payment_gateway_charge' => 5.0,
        ]);
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_team_members_cannot_store_a_charge()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        $this->actingAs($user);
        session()->setPreviousUrl('/login');
        $response = $this->post(route('admin.charges.store'), [
            'country' => 'Guatemala',
            'country_charge' => 3.0,
            'payment_gateway' => 'pagalogt',
            'payment_gateway_charge' => 5.0,
        ]);
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_app_admins_cannot_store_a_charge_with_invalid_data()
    {
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        $this->actingAs($user);
        session()->setPreviousUrl('/login');
        $response = $this->post(route('admin.charges.store'), [
            'country' => '',
            'income' => 'lorem',
            'gateway' => 'any',
            'gateway_charge' => '',
        ]);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['country', 'income', 'gateway', 'gateway_charge']);
        $this->assertDatabaseCount('charges', 0);
    }
    /**@test */
    public function test_app_admins_can_store_a_charge()
    {
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        $this->actingAs($user);
        session()->setPreviousUrl('/login');
        $response = $this->post(route('admin.charges.store'), [
            'country' => 'Guatemala',
            'income' => 3,
            'gateway' => 'pagalogt',
            'gateway_charge' => 5,
        ]);
        $response->assertRedirect();
        $response->assertSessionHas(['success']);
        $this->assertDatabaseCount('charges', 1);
    }
}
