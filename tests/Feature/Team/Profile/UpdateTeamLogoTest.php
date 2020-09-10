<?php

namespace Tests\Feature\Team\Profile;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateTeamLogoTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guests_cannot_upload_team_logo()
    {
        Storage::fake('s3');
        $team = factory(Team::class)->create();
        $oldLogo = $team->logo;
        $response = $this->put(route('teams.profile.update_logo', $team), [
            'logo' => UploadedFile::fake()->image('photo1.jpg'),
        ]);
        $response->assertRedirect();
        $team->refresh();
        $this->assertEquals($oldLogo, $team->logo);
        Storage::disk('s3')->assertMissing('teams_logos/' . basename($team->logo));
    }
    /** @test */
    public function test_auth_users_but_not_team_members_cannot_upload_team_logo()
    {
        Storage::fake('s3');
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $oldLogo = $team->logo;
        $response = $this->put(route('teams.profile.update_logo', $team), [
            'logo' => UploadedFile::fake()->image('photo1.jpg'),
        ]);
        $response->assertRedirect();
        $team->refresh();
        $this->assertEquals($oldLogo, $team->logo);
        Storage::disk('s3')->assertMissing('teams_logos/' . basename($team->logo));
    }
    /** @test */
    public function test_team_members_cannot_upload_team_logo_with_invalid_data()
    {
        Storage::fake('s3');
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $team->users()->attach($user);
        $oldLogo = $team->logo;
        $faker = \Faker\Factory::create();
        $response = $this->put(route('teams.profile.update_logo', $team), [
            'logo' => $faker->name,
        ]);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['logo']);
        $team->refresh();
        $this->assertEquals($oldLogo, $team->logo);
        Storage::disk('s3')->assertMissing('teams_logos/' . basename($team->logo));
    }
    /** @test */
    public function test_team_members_can_upload_team_logo()
    {
        Storage::fake('s3');
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $team->users()->attach($user);
        $oldLogo = $team->logo;
        $response = $this->put(route('teams.profile.update_logo', $team), [
            'logo' => UploadedFile::fake()->image('photo1.jpg'),
        ]);
        $response->assertRedirect();
        $team->refresh();
        $this->assertNotEquals($oldLogo, $team->logo);
        Storage::disk('s3')->assertExists('teams_logos/' . basename($team->logo));
    }
}
