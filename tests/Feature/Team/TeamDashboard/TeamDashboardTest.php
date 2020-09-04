<?php

namespace Tests\Feature\Team\TeamDashboard;

use App\Models\Role;
use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamDashboardTest extends TestCase
{
    use RefreshDatabase;
    /*** @test*/
    public function test_guests_cannot_access_team_dashboard()
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect();
    }

    public function test_authenticated_users_from_other_team_cannot_access_team_dashboard()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        factory(Team::class)->create();
        $url = route('team.dashboard', ['team' => Team::first()->slug]);
        $response = $this->get($url);
        $response->assertRedirect();
    }

    public function test_admin_users_can_access_team_dashboard()
    {
        $user = factory(User::class)->create();
        factory(Team::class)->create();
        $this->attachRoleAdminToUser($user);
        $this->actingAs($user);
        $url = route('team.dashboard', ['team' => Team::first()->slug]);
        $response = $this->get($url);
        $response->assertOk();
    }

    public function attachRoleAdminToUser(User $user)
    {
        $user->roles()->save(
            factory(Role::class)->make([
                'name' => 'admin'
            ])
        );
        $user->roles()->attach(Role::first());
    }

    public function test_authenticated_users_can_access_team_dashboard()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $user->teams()->save(factory(Team::class)->make());
        $response = $this->get(route('dashboard', Team::first()));
        $response->assertOk();
    }
}
