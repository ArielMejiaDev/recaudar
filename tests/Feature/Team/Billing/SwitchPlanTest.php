<?php

namespace Tests\Feature\Team\Billing;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SwitchPlanTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testGuestsCannotAccessToSwitchPlanFeature()
    {
        $team = factory(Team::class)->create();

        $response = $this->from(
            route('login')
        )->get(
            route('teams.switch-plan.show', ['team' => $team])
        );

        $response->assertRedirect();
        $response->assertLocation(
            route('login')
        );
    }
    /** @test */
    public function testNotAdminUsersCannotAccessToSwitchPlanFeature()
    {
        $team = factory(Team::class)->create();

        $user = factory(User::class)->create();

        $team->users()->attach($user, ['role_name' => 'team_editor']);

        $this->actingAs($user);

        $response = $this->from(
            route('login')
        )->get(
            route('teams.switch-plan.show', ['team' => $team])
        );

        $response->assertStatus(403);
    }
    /** @test */
    public function testAdminUserCanAccessToSwitchPlanFeature()
    {
        $team = factory(Team::class)->create();

        $user = factory(User::class)->create();

        $team->users()->attach($user, ['role_name' => 'team_admin']);

        $this->actingAs($user);

        $response = $this->from(
            route('login')
        )->get(
            route('teams.switch-plan.show', ['team' => $team])
        );

        $response->assertOk();
    }
    /** @test */
    public function testNotAdminCannotSwitchPlan()
    {
        $team = factory(Team::class)->create(['plan' => 'free']);

        $user = factory(User::class)->create();

        $team->users()->attach($user, ['role_name' => 'team_editor']);

        $this->actingAs($user);

        $response = $this->from(
            route('teams.switch-plan.show', ['team' => $team]),
        )->put(
            route('teams.switch-plan.update', ['team' => $team]), [
                'plan' => 'another invalid plan',
            ]
        );

        $response->assertStatus(403);
    }
    /** @test */
    public function testAdminCannotSwitchPlanWithInvalidData()
    {
        $team = factory(Team::class)->create(['plan' => 'free']);

        $user = factory(User::class)->create();

        $team->users()->attach($user, ['role_name' => 'team_admin']);

        $this->actingAs($user);

        $response = $this->from(
            route('teams.switch-plan.show', ['team' => $team]),
        )->put(
            route('teams.switch-plan.update', ['team' => $team]), [
                'plan' => 'another invalid plan',
            ]
        );

        $team->refresh();

        $this->assertNotEquals('pro', $team->plan);

        $response->assertSessionHasErrors(['plan']);
        $response->assertRedirect();
        $response->assertLocation(
            route('teams.switch-plan.show', ['team' => $team]),
        );
    }
    /** @test */
    public function testAdminCanSwitchPlan()
    {
        $team = factory(Team::class)->create(['plan' => 'free']);

        $user = factory(User::class)->create();

        $team->users()->attach($user, ['role_name' => 'team_admin']);

        $this->actingAs($user);

        $response = $this->from(
            route('teams.switch-plan.show', ['team' => $team]),
        )->put(
            route('teams.switch-plan.update', ['team' => $team]), [
                'plan' => 'pro',
            ]
        );

        $team->refresh();

        $this->assertEquals('pro', $team->plan);

        $response->assertSessionHas(['success']);
        $response->assertRedirect();
        $response->assertLocation(
            route('teams.switch-plan.show', ['team' => $team]),
        );
    }
}
