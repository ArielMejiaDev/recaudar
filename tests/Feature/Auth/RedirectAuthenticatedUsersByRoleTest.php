<?php

namespace Tests\Feature\Auth;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectAuthenticatedUsersByRoleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_app_admins_redirect_after_login_to_admin_dashboard()
    {
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'app_admin']);

        session()->setPreviousUrl('/login');
        $this->actingAs($user);

        $response = $this->get('/login');

        $response->assertRedirect();
        $response->assertLocation(route('admin.dashboard'));
    }
    /** @test */
    public function test_team_admins_redirect_after_login_to_admin_dashboard()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);

        session()->setPreviousUrl('/login');
        $this->actingAs($user);

        $response = $this->get('/login');

        $response->assertRedirect();
        $response->assertLocation(route('teams.index'));
    }
}
