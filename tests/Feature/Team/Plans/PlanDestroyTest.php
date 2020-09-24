<?php

namespace Tests\Feature\Team\Plans;

use App\Models\Plan;
use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlanDestroyTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guests_cannot_delete_a_team_plan()
    {
        $team = factory(Team::class)->create();
        $plan = factory(Plan::class)->create();
        $team->plans()->attach($plan);
        $response = $this->delete(route('teams.plans.destroy', ['team' => $team, 'plan' => $plan]));
        $response->assertRedirect(route('login'));
    }
    /** @test */
    public function test_auth_users_but_not_team_members_cannot_delete_a_team_plan()
    {
        $team = factory(Team::class)->create();
        $plan = factory(Plan::class)->create();
        $team->plans()->attach($plan);

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->delete(route('teams.plans.destroy', ['team' => $team, 'plan' => $plan]));
        $response->assertRedirect('/');
    }
    /** @test */
    public function test_team_members_can_delete_a_team_plan()
    {
        $team = factory(Team::class)->create();
        $team->plans->first()->delete();
        $plan = factory(Plan::class)->create();
        $team->plans()->attach($plan);

        $user = factory(User::class)->create();
        $this->actingAs($user);
        $user->teams()->attach($team);

        $response = $this->delete(route('teams.plans.destroy', ['team' => $team, 'plan' => $plan]));
        $response->assertRedirect();
        $response->assertSessionHas(['warning']);
        $this->assertCount(0, Plan::all());
    }
}
