<?php

namespace Tests\Feature\Team\User;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserEditTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guest_cannot_access_to_team_users_edit()
    {
        $team = factory(Team::class)->create();
        $exampleUser = factory(User::class)->create();
        $team->users()->attach($exampleUser);

        $response = $this->get(route('teams.users.edit', ['team' => $team, 'user' => $exampleUser]));
        $response->assertRedirect();
    }
    /** @test */
    public function test_auth_users_but_not_team_members_cannot_access_to_team_users_edit()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $exampleUser = factory(User::class)->create();
        $team->users()->attach($exampleUser);

        $response = $this->get(route('teams.users.edit', ['team' => $team, 'user' => $exampleUser]));
        $response->assertRedirect();
    }
    /** @test */
    public function test_team_members_can_access_to_team_users_edit()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $team->users()->attach($user);

        $exampleUser = factory(User::class)->create();
        $team->users()->attach($exampleUser);

        $response = $this->get(route('teams.users.edit', ['team' => $team, 'user' => $exampleUser]));
        $response->assertOk();
    }
    /** @test */
    public function test_team_users_role_cannot_be_updated_with_invalid_data()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $team->users()->attach($user);

        $exampleUser = factory(User::class)->create();
        $team->users()->attach($exampleUser);

        $response = $this->put(route('teams.users.update', ['team' => $team, 'user' => $exampleUser]), [
            'role' => 'editor',
        ]);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['role']);
    }
    /** @test */
    public function test_team_users_role_can_be_updated()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $team->users()->attach($user);

        $exampleUser = factory(User::class)->create();
        $team->users()->attach($exampleUser, ['role_name' => 'team_financial']);

        $response = $this->put(route('teams.users.update', ['team' => $team, 'user' => $exampleUser]), [
            'role' => 'team_editor',
        ]);
        $response->assertSessionHas(['success']);
    }
}
