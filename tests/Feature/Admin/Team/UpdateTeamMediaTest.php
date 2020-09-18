<?php

namespace Tests\Feature\Admin\Team;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateTeamMediaTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guests_cannot_update_team_media()
    {
        $team = factory(Team::class)->create();
        $response = $this->put(route('admin.teams.update-media', $team));
        session()->setPreviousUrl('/login');
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /** @test */
    public function test_auth_users_but_not_team_members_cannot_update_team_media()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        $this->actingAs($user);
        session()->setPreviousUrl('/login');
        $response = $this->put(route('admin.teams.update-media', $team));
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /** @test */
    public function test_app_admins_cannot_update_team_media_with_invalid_data()
    {
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        $this->actingAs($user);

        $anotherTeam = factory(Team::class)->create();

        Storage::fake('s3');

        session()->setPreviousUrl(route('admin.teams.edit', $anotherTeam));

        $response = $this->put(route('admin.teams.update-media', $anotherTeam), [
            'logo' => 'logo.jpg',
            'banner' => 'banner.jpg',
        ]);

        $anotherTeam->refresh();

        Storage::disk('s3')->assertMissing('teams_logos/' . basename($anotherTeam->logo));
        Storage::disk('s3')->assertMissing('teams_banners/' . basename($anotherTeam->banner));
        $response->assertRedirect();
        $response->assertLocation(route('admin.teams.edit', $anotherTeam));
        $response->assertSessionHasErrors(['logo', 'banner']);
    }
    /** @test */
    public function test_app_admins_can_update_team_media()
    {
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'app_admin']);
        $this->actingAs($user);

        $anotherTeam = factory(Team::class)->create();

        Storage::fake('s3');

        session()->setPreviousUrl(route('admin.teams.edit', $anotherTeam));

        $response = $this->put(route('admin.teams.update-media', $anotherTeam), [
            'logo' => UploadedFile::fake()->image('logo.jpg'),
            'banner' => UploadedFile::fake()->image('banner.jpg'),
        ]);

        $anotherTeam->refresh();

        Storage::disk('s3')->assertExists('teams_logos/' . basename($anotherTeam->logo));
        Storage::disk('s3')->assertExists('teams_banners/' . basename($anotherTeam->banner));
        $response->assertRedirect();
        $response->assertLocation(route('admin.teams.index'));
        $response->assertSessionHas(['success']);
    }
}
