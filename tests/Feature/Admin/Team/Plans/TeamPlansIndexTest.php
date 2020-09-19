<?php

namespace Tests\Feature\Admin\Team\Plans;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamPlansIndexTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guests_cannot_access_to_admin_team_plans()
    {
        $team = factory(Team::class)->create();
        session()->setPreviousUrl('/login');
        $response = $this->get(route('admin.teams.plans.index', $team));
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /** @test */
    public function test_auth_users_but_not_team_members_cannot_access_to_admin_team_plans()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        session()->setPreviousUrl('/');
        $this->actingAs($user);
        $response = $this->get(route('admin.teams.plans.index', $team));
        $response->assertRedirect();
        $response->assertLocation('/');
    }
    /** @test */
    public function test_team_members_cannot_access_to_admin_team_plans()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        session()->setPreviousUrl('/');
        $this->actingAs($user);
        $response = $this->get(route('admin.teams.plans.index', $team));
        $response->assertRedirect();
        $response->assertLocation('/');
    }
    /** @test */
    public function test_app_admins_can_access_to_admin_team_plans()
    {
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        session()->setPreviousUrl('/');
        $this->actingAs($user);
        $anotherTeam = factory(Team::class)->create();
        $response = $this->get(route('admin.teams.plans.index', $anotherTeam));
        $response->assertOk();
    }
}
