<?php

namespace Tests\Feature\Admin\Team;

use App\Models\Team;
use App\Notifications\TeamStatusChangeNotification;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Notification;
use Tests\TestCase;

class UpdateTeamStatusTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guests_cannot_update_a_team_status()
    {
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        session()->setPreviousUrl('/login');
        $response = $this->put(route('admin.teams.update-status', $team));
        $response->assertRedirect('/login');
    }
    /** @test */
    public function test_team_admins_cannot_update_team_status()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        session()->setPreviousUrl('/login');
        $response = $this->put(route('admin.teams.update-status', $team));
        $response->assertRedirect('/login');
    }
    /** @test */
    public function test_app_admins_cannot_update_team_status_with_invalid_data()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        session()->setPreviousUrl('/login');
        $this->actingAs($user);
        $anotherTeam = factory(Team::class)->create(['status' => 'pending']);
        $response = $this->put(route('admin.teams.update-status', $anotherTeam), [
            'status' => 'any',
        ]);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['status']);
        $anotherTeam->refresh();
        $this->assertNotEquals('any', $anotherTeam->status);
    }
    /** @test */
    public function test_ap_admins_can_update_team_status()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        session()->setPreviousUrl('/login');
        $this->actingAs($user);

        Notification::fake();

        $anotherTeam = factory(Team::class)->create(['status' => 'pending']);
        $anotherUser = factory(User::class)->create();
        $anotherTeam->users()->attach($anotherUser, ['role_name' => 'team_admin']);

        $response = $this->put(route('admin.teams.update-status', $anotherTeam), [
            'status' => 'pending',
        ]);

        $response->assertRedirect(route('admin.teams.index'));
        $response->assertSessionHas(['success']);
        $response->assertLocation(route('admin.teams.index'));
        $anotherTeam->refresh();
        $this->assertEquals('approved', $anotherTeam->status);

        Notification::assertSentTo($anotherUser, TeamStatusChangeNotification::class);
    }
}
