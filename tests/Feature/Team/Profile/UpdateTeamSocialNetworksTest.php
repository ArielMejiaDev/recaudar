<?php

namespace Tests\Feature\Team\Profile;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTeamSocialNetworksTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guests_cannot_update_team_social_networks()
    {
        $team = factory(Team::class)->create();
        $oldFacebookAccount = $team->facebook_account;
        $faker = \Faker\Factory::create();
        $response = $this->put(route('teams.profile.update_social_networks', $team), [
            'facebook_account' => $faker->url,
            'twitter_account' => $faker->url,
            'instagram_account' => $faker->url,
        ]);
        $response->assertRedirect();
        $team->refresh();
        $this->assertEquals($oldFacebookAccount, $team->facebook_account);
    }
    /** @test */
    public function test_auth_but_not_members_cannot_update_team_social_networks()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $oldFacebookAccount = $team->facebook_account;
        $faker = \Faker\Factory::create();
        $response = $this->put(route('teams.profile.update_social_networks', $team), [
            'facebook_account' => $faker->url,
            'twitter_account' => $faker->url,
            'instagram_account' => $faker->url,
        ]);
        $response->assertRedirect();
        $team->refresh();
        $this->assertEquals($oldFacebookAccount, $team->facebook_account);
    }
    /** @test */
    public function test_members_cannot_update_team_social_networks_with_invalid_data()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $team->users()->attach($user);
        $this->actingAs($user);
        $oldFacebookAccount = $team->facebook_account;
        $faker = \Faker\Factory::create();
        $response = $this->put(route('teams.profile.update_social_networks', $team), [
            'facebook_account' => $faker->name,
            'twitter_account' => $faker->address,
            'instagram_account' => $faker->phoneNumber,
        ]);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['facebook_account', 'twitter_account', 'instagram_account']);
        $team->refresh();
        $this->assertEquals($oldFacebookAccount, $team->facebook_account);
    }
    /** @test */
    public function test_members_can_update_team_social_networks()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $team->users()->attach($user);
        $this->actingAs($user);
        $oldFacebookAccount = $team->facebook_account;
        $faker = \Faker\Factory::create();
        $response = $this->put(route('teams.profile.update_social_networks', $team), [
            'facebook_account' => $faker->url,
            'twitter_account' => $faker->url,
            'instagram_account' => $faker->url,
        ]);
        $response->assertRedirect();
        $team->refresh();
        $this->assertNotEquals($oldFacebookAccount, $team->facebook_account);
    }
}
