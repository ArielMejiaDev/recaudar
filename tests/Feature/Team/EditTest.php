<?php

namespace Tests\Feature\Team;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditTest extends TestCase
{
    public array $validTeamData = [
        'name' => 'Doe Foundation',
        'beneficiaries' => '500',
        'public' => 'lorem ipsum dolor siet lorem ipsum dolor siet',
        'category' => 'Otros',
        'use_of_funds' => 'lorem ipsum dolor siet lorem ipsum dolor siet',
        'impact' => 'lorem ipsum dolor siet lorem ipsum dolor siet',
        'description' => 'lorem ipsum dolor siet lorem ipsum dolor siet',
        'contact' => 'Anne Doe',
        'contact_phone' => '545454545454',
        'contact_email' => 'anne@doe.com',
        'office_address' => 'Venice, Los Angeles, California',
        'legal_representative' => 'John Doe',
        'tax_number' => '3232323232',
        'country' => 'Guatemala',
        'bank' => 'Bank of Guatemala',
        'account_number' => 123456789,
    ];

    use RefreshDatabase;

    /** @test */
    public function test_guests_cannot_access_to_edit_team_page()
    {
        $team = factory(Team::class)->create();
        $response = $this->get(route('teams.edit', $team->slug));
        $response->assertRedirect();
    }

    /** @test */
    public function test_auth_user_but_not_team_member_cannot_access_to_edit_team_page()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create();
        $this->actingAs($user);
        $response = $this->get(route('teams.edit', $team->slug));
        $response->assertRedirect();
    }

    /** @test */
    public function test_auth_user_and_team_member_can_access_to_edit_team_page()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create();
        $this->actingAs($user);
        $user->teams()->attach($team);
        $response = $this->get(route('teams.edit', $team->slug));
        $response->assertOk();
    }

    /** @test */
    public function test_auth_user_but_not_team_member_cannot_update_team_page()
    {
        $unrelatedUser = factory(User::class)->create();
        $anyTeam = factory(Team::class)->create();
        $this->actingAs($unrelatedUser);
        $response = $this->put(route('teams.update', $anyTeam->slug), $this->validTeamData);
        $response->assertRedirect();
        $this->assertNotEquals('Doe Foundation', Team::first()->name);
        $response->assertSessionMissing(['success']);
        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function test_validated_data_to_update_team()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create();
        $this->actingAs($user);
        $user->teams()->attach($team);
        $response = $this->put(route('teams.update', $team->slug), $this->validTeamData);
        $response->assertRedirect();
        $team->refresh();
        $this->assertEquals($team->name, Team::first()->name);
        $response->assertSessionHas(['success']);
        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function test_exceptions_data_to_update_team()
    {
        $user = factory(User::class)->create();
        $team = factory(Team::class)->create();
        $this->actingAs($user);
        $user->teams()->attach($team);
        $response = $this->put(route('teams.update', $team->slug), [
            'name' => '',
            'beneficiaries' => 'lorem',
            'public' => '111111111111111111111',
            'category' => 'anytext',
            'impact' => '.',
            'use_of_funds' => 'et',
            'description' => 'lt',
            'contact' => '',
            'contact_phone' => 'lorem ipsum dolor siet',
            'contact_email' => 'novalidemail.com',
            'office_address' => '333333333333',
            'legal_representative' => '',
            'tax_number' => '',
            'country' => 'Any Country',
            'bank' => '',
            'account_number' => 123,

        ]);
        $response->assertRedirect();
        $this->assertNotEquals('anytext', Team::first()->category);
        $response->assertSessionMissing(['success']);
        $response->assertSessionHasErrors();
    }
}
