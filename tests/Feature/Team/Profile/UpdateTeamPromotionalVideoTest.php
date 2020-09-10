<?php

namespace Tests\Feature\Team\Profile;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTeamPromotionalVideoTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guests_cannot_update_promotional_video()
    {
        $team = factory(Team::class)->create();
        $oldPromotionalVideo = $team->promotional_video;
        $faker = \Faker\Factory::create();
        $response = $this->put(route('teams.profile.update_promotional_video', $team),
        [
            'promotional_video' => $faker->url,
        ]);
        $response->assertRedirect();
        $team->refresh();
        $this->assertEquals($oldPromotionalVideo, $team->promotional_video);
    }
    /** @test */
    public function test_auth_users_but_not_team_members_cannot_update_promotional_video()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $oldPromotionalVideo = $team->promotional_video;
        $faker = \Faker\Factory::create();
        $response = $this->put(route('teams.profile.update_promotional_video', $team),
            [
                'promotional_video' => $faker->url,
            ]);
        $response->assertRedirect();
        $team->refresh();
        $this->assertEquals($oldPromotionalVideo, $team->promotional_video);
    }
    /** @test */
    public function test_team_members_cannot_update_promotional_video_with_invalid_data()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $team->users()->attach($user);
        $this->actingAs($user);
        $oldPromotionalVideo = $team->promotional_video;
        $faker = \Faker\Factory::create();
        $response = $this->put(route('teams.profile.update_promotional_video', $team),
            [
                'promotional_video' => $faker->name,
            ]);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['promotional_video']);
        $team->refresh();
        $this->assertEquals($oldPromotionalVideo, $team->promotional_video);
    }
    /** @test */
    public function test_team_members_can_update_promotional_video()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $team->users()->attach($user);
        $this->actingAs($user);
        $oldPromotionalVideo = $team->promotional_video;
        $faker = \Faker\Factory::create();
        $response = $this->put(route('teams.profile.update_promotional_video', $team),
            [
                'promotional_video' => $faker->url,
            ]);
        $response->assertRedirect();
        $team->refresh();
        $this->assertNotEquals($oldPromotionalVideo, $team->promotional_video);
    }
}
