<?php

namespace Tests\Feature\Team\Profile;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTeamThemeTest extends TestCase
{
    /* @test */
    use RefreshDatabase;

    public function test_guests_cannot_access_to_edit_team_theme()
    {
        session()->setPreviousUrl('/login');
        $team = factory(Team::class)->create();
        $response = $this->get(route('teams.profile', ['team' => $team]));
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    public function test_auth_users_but_not_team_members_cannot_access_to_edit_team_theme()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        session()->setPreviousUrl('/');
        $team = factory(Team::class)->create();
        $response = $this->get(route('teams.profile', ['team' => $team]));
        $response->assertRedirect();
        $response->assertLocation('/');
    }
    public function test_team_members_with_role_admin_can_access_to_edit_team_theme()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        session()->setPreviousUrl('/');
        $team = factory(Team::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        $response = $this->get(route('teams.profile', ['team' => $team]));
        $response->assertOk();
    }
    public function test_theme_cannot_be_updated_with_invalid_data()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        session()->setPreviousUrl('/');
        $team = factory(Team::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        $response = $this->put(route('teams.profile.update_theme', ['team' => $team]), [
            'theme' => '',
        ]);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['theme']);
        $this->assertNotEquals('classic', Team::first()->theme);
    }
    public function test_theme_can_be_updated()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        session()->setPreviousUrl('/');
        $team = factory(Team::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        $response = $this->put(route('teams.profile.update_theme', ['team' => $team]), [
            'theme' => 'classic',
        ]);
        $response->assertRedirect();
        $response->assertLocation(route('teams.profile', $team));
        $response->assertSessionHas(['success']);
        $this->assertEquals('classic', Team::first()->theme);
    }
}
