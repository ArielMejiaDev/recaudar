<?php

namespace Tests\Feature\Admin\Team;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTeamProfileTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guests_cannot_update_a_team_profile()
    {
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        session()->setPreviousUrl('/login');
        $response = $this->put(route('admin.teams.update-profile', $team));
        $response->assertRedirect('/login');
    }
    /** @test */
    public function test_team_admins_cannot_update_team_profile()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        session()->setPreviousUrl('/login');
        $anotherTeam = factory(Team::class)->create();
        $response = $this->put(route('admin.teams.update-profile', $anotherTeam));
        $response->assertRedirect('/login');
    }
    /** @test */
    public function test_app_admins_cannot_update_team_profile_with_invalid_data()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        session()->setPreviousUrl(route('admin.teams.index'));
        $this->actingAs($user);
        $anotherTeam = factory(Team::class)->create();
        $response = $this->put(route('admin.teams.update-profile', $anotherTeam), [
            'name' => '',
            'beneficiaries' => '',
            'public' => '',
            'status' => 'any',
            'category' => 'any',
            'theme' => 'any',
            'impact' => '',
            'description' => '...',
            'use_of_funds' => 'text',
        ]);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['name', 'beneficiaries', 'public', 'status', 'category', 'theme', 'impact', 'description', 'use_of_funds']);
        $anotherTeam->refresh();
        $this->assertNotEquals('', $anotherTeam->name);
    }
    /** @test */
    public function test_app_admins_can_update_team_profile()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        session()->setPreviousUrl(route('admin.teams.index'));
        $this->actingAs($user);
        $anotherTeam = factory(Team::class)->create();
        $response = $this->put(route('admin.teams.update-profile', $anotherTeam), [
            'name' => 'John Doe foundation',
            'beneficiaries' => 100,
            'public' => 'Childrens & Teenagers',
            'status' => 'pending',
            'category' => 'Salud',
            'theme' => 'classic',
            'impact' => 'lorem ipsum dolor siet impact...',
            'description' => 'lorem ipsum dolor siet description ...',
            'use_of_funds' => 'We buy medicines to provide medical care attention to children around the world',
        ]);
        $response->assertRedirect(route('admin.teams.index'));
        $response->assertSessionHas(['success']);
        $response->assertLocation(route('admin.teams.index'));
        $anotherTeam->refresh();
        $this->assertEquals('John Doe foundation', $anotherTeam->name);
    }
}
