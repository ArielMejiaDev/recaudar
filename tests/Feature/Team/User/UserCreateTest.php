<?php

namespace Tests\Feature\Team\User;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCreateTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guest_cannot_access_to_team_users_create()
    {
        $team = factory(Team::class)->create();
        $response = $this->get(route('teams.users.index', $team));
        $response->assertRedirect();
    }
    /** @test */
    public function test_auth_users_but_not_team_members_cannot_access_to_team_users_create()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get(route('teams.users.index', $team));
        $response->assertRedirect();
    }
    /** @test */
    public function test_team_members_can_access_to_team_users_create()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $team->users()->attach($user);
        $response = $this->get(route('teams.users.index', $team));
        $response->assertOk();
    }
    /** @test */
    public function test_team_users_cannot_create_and_invited_user_with_invalid_data()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $team->users()->attach($user);
        $response = $this->post(route('teams.users.store', $team), [
            'name' => '',
            'email' => 'johndoe.com',
            'role' => 'editor',
        ]);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['name', 'email', 'role']);
    }
    /** @test */
    public function test_team_users_can_be_created_and_invited()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $team->users()->attach($user);
        $response = $this->post(route('teams.users.store', $team), [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'role' => 'team_editor',
        ]);
        $this->assertDatabaseCount('users', 2);
        $this->assertEquals('John Doe', User::find(2)->name);
        $response->assertSessionHas(['success']);
    }
    /** @test */
    public function test_users_that_already_exists_can_be_invited()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $team->users()->attach($user);

        $exampleUser = factory(User::class)->create([
            'name' => 'John Doe',
            'email' => 'john@doe.com',
        ]);

        $response = $this->post(route('teams.users.store', $team), [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'role' => 'team_editor',
        ]);

        $this->assertDatabaseCount('users', 2);
        $this->assertEquals('John Doe', User::find(2)->name);
        $exampleUser->refresh();
        // role is a pivot table model look on User model method role is an accessor to this
        $this->assertEquals('team_editor', $exampleUser->teams->first()->role->role_name);
        $response->assertSessionHas(['success']);
    }
}
