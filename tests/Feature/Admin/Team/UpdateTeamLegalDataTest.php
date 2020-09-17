<?php

namespace Tests\Feature\Admin\Team;

use App\Models\Team;
use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTeamLegalDataTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guests_cannot_update_a_team_legal_data()
    {
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        session()->setPreviousUrl('/login');
        $response = $this->put(route('admin.teams.update-legal-data', $team));
        $response->assertRedirect('/login');
    }
    /** @test */
    public function test_team_admins_cannot_update_team_legal_data()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        session()->setPreviousUrl('/login');
        $anotherTeam = factory(Team::class)->create();
        $response = $this->put(route('admin.teams.update-legal-data', $anotherTeam));
        $response->assertRedirect('/login');
    }
    /** @test */
    public function test_app_admins_cannot_update_team_legal_data_without_valid_data()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        session()->setPreviousUrl(route('admin.teams.index'));
        $this->actingAs($user);
        $faker = Factory::create();
        $anotherTeam = factory(Team::class)->create([
            'legal_representative' => 'Anne Doe',
            'tax_number' => 12345678,
            'country' => 'Guatemala',
            'account_number' => $faker->bankAccountNumber,
            'bank' => $faker->company,
        ]);
        $response = $this->put(route('admin.teams.update-legal-data', $anotherTeam), [
            'legal_representative' => '',
            'tax_number' => '',
            'country' => 'any country',
            'account_number' => 123,
            'bank' => 'any',
        ]);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['legal_representative', 'tax_number', 'country', 'account_number', 'bank']);
        $anotherTeam->refresh();
        $this->assertNotEquals('', $anotherTeam->legal_representative);
    }
    /** @test */
    public function test_app_admins_can_update_team_legal_data()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        session()->setPreviousUrl(route('admin.teams.index'));
        $this->actingAs($user);
        $faker = Factory::create();
        $anotherTeam = factory(Team::class)->create([
            'legal_representative' => 'Anne Doe',
            'tax_number' => 12345678,
            'country' => 'Guatemala',
            'account_number' => $faker->bankAccountNumber,
            'bank' => $faker->company,
        ]);
        $response = $this->put(route('admin.teams.update-legal-data', $anotherTeam), [
            'legal_representative' => 'Annie Doe',
            'tax_number' => 123456789,
            'country' => 'Honduras',
            'account_number' => '123-444-02133',
            'bank' => 'Bank of Guatemala',
        ]);
        $response->assertRedirect(route('admin.teams.index'));
        $response->assertSessionHas(['success']);
        $response->assertLocation(route('admin.teams.index'));
        $anotherTeam->refresh();
        $this->assertEquals('Annie Doe', $anotherTeam->legal_representative);
    }
}
