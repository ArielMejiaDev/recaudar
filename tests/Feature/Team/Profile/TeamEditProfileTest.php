<?php

namespace Tests\Feature\Team\Profile;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamEditProfileTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guest_cannot_access_to_edit_profile()
    {
        $team = factory(Team::class)->create();
        $response = $this->get(route('teams.profile', $team));
        $response->assertRedirect();
    }
    /** @test */
    public function test_auth_users_but_not_team_members_cannot_access_to_edit_profile()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get(route('teams.profile', $team));
        $response->assertRedirect();
    }
    /** @test */
    public function test_team_members_can_access_to_edit_profile()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $team->users()->attach($user);
        $response = $this->get(route('teams.profile', $team));
        $response->assertOk();
    }

    public function test_edit_profile_show_team_data()
    {
        $team = factory(Team::class)->create(['name' => 'Doe Foundation']);
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $team->users()->attach($user);
        $response = $this->get(route('teams.profile', $team));
        $response->assertOk();
        $response->assertPropValue('team', function($team) {
            $this->assertEquals('Doe Foundation', $team['name']);
        });
    }
}
