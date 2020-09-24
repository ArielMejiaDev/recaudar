<?php

namespace Tests\Feature\Team\Plans;

use App\Models\Plan;
use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlanIndexTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guests_cannot_access_to_teams_plans_index()
    {
        $team = factory(Team::class)->create();
        $response = $this->get(route('teams.plans.index', $team));
        $response->assertRedirect();
    }
    /** @test */
    public function test_auth_users_but_not_team_members_cannot_access_to_teams_plans_index()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get(route('teams.plans.index', $team));
        $response->assertRedirect();
    }
    /** @test */
    public function test_team_members_can_access_to_teams_plans_index()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $user->teams()->attach($team);
        $response = $this->get(route('teams.plans.index', $team));
        $response->assertOk();
    }
    /** @test */
    public function test_team_members_can_access_to_teams_plans_index_and_view_plans()
    {
        $team = factory(Team::class)->create();
        $team->plans->first()->delete();
        $team->plans()->save(factory(Plan::class)->make());
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $user->teams()->attach($team);
        $response = $this->get(route('teams.plans.index', $team));
        $response->assertOk();
        $response->assertPropCount('plans.data', 1);
        $team->refresh();
        $response->assertPropValue('plans.data', function($plan) use($team) {
            $this->assertEquals($team->plans->first()->title, $plan[0]['title']);
        });
    }
}
