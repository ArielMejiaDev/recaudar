<?php

namespace Tests\Feature\Team\User;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserIndexTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guest_cannot_access_to_team_users_index()
    {
        $team = factory(Team::class)->create();
        $response = $this->get(route('teams.users.index', $team));
        $response->assertRedirect();
    }
    /** @test */
    public function test_auth_users_but_not_team_members_cannot_access_to_team_users_index()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get(route('teams.users.index', $team));
        $response->assertRedirect();
    }
    /** @test */
    public function test_team_members_can_access_to_team_users_index()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $team->users()->attach($user);
        $response = $this->get(route('teams.users.index', $team));
        $response->assertOk();
    }
    /** @test */
    public function test_team_users_index_show_users()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        $this->actingAs($user);

        $exampleUser = factory(User::class)->create(['name' => 'John Doe']);
        $team->users()->attach($exampleUser, ['role_name' => 'team_member']);

        $response = $this->get(route('teams.users.index', $team));
        $response->assertOk();
        $response->assertPropCount('users.data', 1);
        $response->assertPropValue('users.data', function($user) {
            $this->assertEquals('John Doe', $user[0]['name']);
        });
    }
}
