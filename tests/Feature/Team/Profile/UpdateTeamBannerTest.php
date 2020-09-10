<?php

namespace Tests\Feature\Team\Profile;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateTeamBannerTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guests_cannot_upload_team_banner()
    {
        Storage::fake('s3');
        $team = factory(Team::class)->create();
        $oldBanner = $team->banner;
        $response = $this->put(route('teams.profile.update_banner', $team), [
            'banner' => UploadedFile::fake()->image('photo1.jpg'),
        ]);
        $response->assertRedirect();
        $team->refresh();
        $this->assertEquals($oldBanner, $team->banner);
        Storage::disk('s3')->assertMissing('teams_banners/' . basename($team->banner));
    }
    /** @test */
    public function test_auth_users_but_not_team_members_cannot_upload_team_banner()
    {
        Storage::fake('s3');
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $oldBanner = $team->banner;
        $response = $this->put(route('teams.profile.update_banner', $team), [
            'banner' => UploadedFile::fake()->image('photo1.jpg'),
        ]);
        $response->assertRedirect();
        $team->refresh();
        $this->assertEquals($oldBanner, $team->banner);
        Storage::disk('s3')->assertMissing('teams_banners/' . basename($team->banner));
    }
    /** @test */
    public function test_team_members_cannot_upload_team_banner_with_invalid_data()
    {
        Storage::fake('s3');
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $team->users()->attach($user);
        $oldBanner = $team->banner;
        $faker = \Faker\Factory::create();
        $response = $this->put(route('teams.profile.update_banner', $team), [
            'banner' => $faker->name,
        ]);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['banner']);
        $team->refresh();
        $this->assertEquals($oldBanner, $team->banner);
        Storage::disk('s3')->assertMissing('teams_banners/' . basename($team->banner));
    }
    /** @test */
    public function test_team_members_can_upload_team_banner()
    {
        Storage::fake('s3');
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $team->users()->attach($user);
        $oldBanner = $team->banner;
        $response = $this->put(route('teams.profile.update_banner', $team), [
            'banner' => UploadedFile::fake()->image('photo1.jpg'),
        ]);
        $response->assertRedirect();
        $team->refresh();
        $this->assertNotEquals($oldBanner, $team->banner);
        Storage::disk('s3')->assertExists('teams_banners/' . basename($team->banner));
    }
}
