<?php

namespace Tests\Feature\Team;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_guest_cannot_delete_a_team()
    {
        $team = factory(Team::class)->create();
        $response = $this->delete(route('teams.delete', $team));
        $response->assertRedirect();
    }

    /** @test */
    public function test_auth_user_but_not_team_member_cannot_delete_a_team()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $team = factory(Team::class)->create();
        $response = $this->delete(route('teams.delete', $team));
        $response->assertRedirect();
        $this->assertDatabaseCount('teams', 1);
        $this->assertEquals($team->slug, Team::first()->slug);
    }

    /** @test */
    public function test_auth_user_and_team_member_can_delete_a_team()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $team = factory(Team::class)->create();
        $user->teams()->attach($team->id);
        $this->delete(route('teams.delete', $team));
        $this->assertDatabaseCount('teams', 1);
        $this->assertEquals(null, Team::first());
        $this->assertEquals($team->slug, Team::onlyTrashed()->first()->slug);
    }
}
