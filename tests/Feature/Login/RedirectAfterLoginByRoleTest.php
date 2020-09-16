<?php

namespace Tests\Feature\Login;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectAfterLoginByRoleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_team_member_can_login_and_go_to_teams_index()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        session()->setPreviousUrl('/login');
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertLocation(route('teams.index'));
    }
    /** @test */
    public function test_app_admin_can_login_and_go_to_admin_dashboard()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create();
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        session()->setPreviousUrl('/login');
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertLocation(route('admin.dashboard'));
    }
}
