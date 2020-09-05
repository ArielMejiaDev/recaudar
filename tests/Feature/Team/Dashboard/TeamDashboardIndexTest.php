<?php

namespace Tests\Feature\Team\Dashboard;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamDashboardIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_team_dashboard_page_is_not_available_for_guests()
    {
        $team = factory(Team::class)->create();
        $response = $this->get(route('teams.dashboard', $team->slug));
        $response->assertRedirect();
    }

    /** @test */
    public function test_team_dashboard_page_is_not_available_for_authenticated_users_that_are_not_team_members()
    {
        $user = factory(User::class)->create();
        $anyTeam = factory(Team::class)->create();
        $this->actingAs($user);
        $response = $this->get(route('teams.dashboard', $anyTeam->slug));
        $response->assertRedirect();
    }

    /** @test */
    public function test_team_dashboard_page_is_available_for_authenticated_users()
    {
        $user = factory(User::class)->create();
        $expectedTeam = factory(Team::class)->create();
        $this->actingAs($user);
        $user->teams()->attach($expectedTeam->id);
        $response = $this->get(route('teams.dashboard', $expectedTeam->slug));
        $response->assertOk();
    }
}
