<?php

namespace Tests\Feature\Admin\Team\Plans;

use App\Models\Plan;
use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamPlanEditTest extends TestCase
{
    use RefreshDatabase;
    /**@test */
    public function test_guests_cannot_access_to_admin_team_plan_edit_form()
    {
        session()->setPreviousUrl('/login');
        $team = factory(Team::class)->create();
        $plan = $team->plans()->save(factory(Plan::class)->make());
        $response = $this->get(route('admin.teams.plans.edit', ['team' => $team, 'plan' => $plan]));
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_auth_users_but_not_team_members_cannot_access_to_admin_team_plan_edit_form()
    {
        session()->setPreviousUrl('/login');
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $plan = $team->plans()->save(factory(Plan::class)->make());
        $response = $this->get(route('admin.teams.plans.edit', ['team' => $team, 'plan' => $plan]));
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_team_members_cannot_access_to_admin_team_plan_edit_form()
    {
        session()->setPreviousUrl('/login');

        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);

        $this->actingAs($user);

        $anotherTeam = factory(Team::class)->create();
        $plan = $anotherTeam->plans()->save(factory(Plan::class)->make());


        $response = $this->get(route('admin.teams.plans.edit', ['team' => $anotherTeam, 'plan' => $plan]));
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_app_admins_can_access_to_admin_team_plan_edit_form()
    {
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'app_admin']);

        $this->actingAs($user);

        session()->setPreviousUrl('/');

        $anotherTeam = factory(Team::class)->create();
        $plan = $anotherTeam->plans()->save(factory(Plan::class)->make());


        $response = $this->get(route('admin.teams.plans.edit', ['team' => $anotherTeam, 'plan' => $plan]));

        $response->assertOk();
        $this->assertEquals(url()->current(), route('admin.teams.plans.edit', ['team' => $anotherTeam, 'plan' => $plan]));
    }
}
