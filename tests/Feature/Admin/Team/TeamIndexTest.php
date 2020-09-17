<?php

namespace Tests\Feature\Admin\Team;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamIndexTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guests_cannot_access_to_admin_team_index()
    {
        $response = $this->get(route('admin.teams.index'));
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /** @test */
    public function test_team_admins_cannot_access_to_admin_team_index()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        $this->actingAs($user);
        session()->setPreviousUrl(route('teams.index', $team));
        $response = $this->get(route('admin.teams.index'));
        $response->assertRedirect();
        $response->assertLocation(route('teams.index', $team));
    }
    /** @test */
    public function test_app_admin_can_access_to_admin_teams_index()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        $this->actingAs($user);
        session()->setPreviousUrl('/');
        $response = $this->get(route('admin.teams.index'));
        $response->assertOk();
    }
}
