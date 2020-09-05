<?php

namespace Tests\Feature\Team;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test*/
    public function test_guests_cannot_access_to_team_index()
    {
        $response = $this->get(route('teams.index'));
        $response->assertRedirect();
    }

    /** @test*/
    public function test_authenticated_users_from_other_team_cannot_access_team_dashboard()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        factory(Team::class)->create();
        $url = route('teams.index');
        $response = $this->get($url);
        $response->assertPropCount('teams', 0);
        $response->assertPropValue('teams', function($team) {
            $this->assertEquals([], $team);
        });
        $response->assertOk();
    }

    /** @test*/
    public function test_authenticated_users_can_access_team_dashboard()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $user->teams()->save(factory(Team::class)->make());
        $response = $this->get(route('teams.index', Team::first()));
        $response->assertOk();
    }
}
