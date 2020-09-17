<?php

namespace Tests\Feature\Admin\Team;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTeamContactTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guests_cannot_update_a_team_contact()
    {
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        session()->setPreviousUrl('/login');
        $response = $this->put(route('admin.teams.update-contact', $team));
        $response->assertRedirect('/login');
    }
    /** @test */
    public function test_team_admins_cannot_update_team_contact()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        session()->setPreviousUrl('/login');
        $anotherTeam = factory(Team::class)->create();
        $response = $this->put(route('admin.teams.update-contact', $anotherTeam));
        $response->assertRedirect('/login');
    }
    /** @test */
    public function test_app_admins_cannot_update_team_profile_without_valid_data()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        session()->setPreviousUrl(route('admin.teams.index'));
        $this->actingAs($user);
        $anotherTeam = factory(Team::class)->create();
        $response = $this->put(route('admin.teams.update-contact', $anotherTeam), [
            'contact' => '',
            'contact_phone' => '',
            'contact_email' => 'johndoe.com',
            'office_address' => 'Venice',
        ]);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['contact', 'contact_phone', 'contact_email', 'office_address']);
        $anotherTeam->refresh();
        $this->assertNotEquals('', $anotherTeam->contact);
    }
    /** @test */
    public function test_app_admins_can_update_team_profile()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        session()->setPreviousUrl(route('admin.teams.index'));
        $this->actingAs($user);
        $anotherTeam = factory(Team::class)->create(['status' => 'pending']);
        $response = $this->put(route('admin.teams.update-contact', $anotherTeam), [
            'contact' => 'John Doe',
            'contact_phone' => 3121415112,
            'contact_email' => 'john@doe.com',
            'office_address' => 'Venice beach, Los Angeles, California',
        ]);
        $response->assertRedirect(route('admin.teams.index'));
        $response->assertSessionHas(['success']);
        $response->assertLocation(route('admin.teams.index'));
        $anotherTeam->refresh();
        $this->assertEquals('John Doe', $anotherTeam->contact);
    }
}
