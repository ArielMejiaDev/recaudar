<?php

namespace Tests\Feature\Admin\Team\Plans;

use App\Models\Plan;
use App\Models\Team;
use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TeamPlanUpdateTest extends TestCase
{
    use RefreshDatabase;
    /**@test */
    public function test_guests_cannot_update_team_plan_on_admin_team_plans()
    {
        session()->setPreviousUrl('/login');
        $team = factory(Team::class)->create();
        $plan = $team->plans()->save(factory(Plan::class)->make());
        $response = $this->put(route('admin.teams.plans.update', ['team' => $team, 'plan' => $plan]), [
            'title' => 'lorem ipsum plan',
        ]);
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_auth_users_but_not_team_members_cannot_update_team_plan_on_admin_team_plans()
    {
        session()->setPreviousUrl('/login');

        $team = factory(Team::class)->create();
        $plan = $team->plans()->save(factory(Plan::class)->make());

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->put(route('admin.teams.plans.update', ['team' => $team, 'plan' => $plan]), [
            'title' => 'lorem ipsum plan',
        ]);

        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_team_members_cannot_update_team_plan_on_admin_team_plans()
    {
        session()->setPreviousUrl('/login');

        $team = factory(Team::class)->create();
        $plan = $team->plans()->save(factory(Plan::class)->make());

        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);
        $this->actingAs($user);

        $response = $this->put(route('admin.teams.plans.update', ['team' => $team, 'plan' => $plan]), [
            'title' => 'lorem ipsum plan',
        ]);

        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    /**@test */
    public function test_admins_cannot_update_team_plan_on_admin_team_plans_with_invalid_data()
    {
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'app_admin']);

        $this->actingAs($user);

        $anotherTeam = factory(Team::class)->create();
        $plan = $anotherTeam->plans()->save(factory(Plan::class)->make());

        session()->setPreviousUrl(route('admin.teams.plans.edit', ['team' => $anotherTeam, 'plan' => $plan]));

        $response = $this->put(route('admin.teams.plans.update', ['team' => $anotherTeam, 'plan' => $plan]), [
            'title' => $planTitleExpected = '',
            'info' => 'txt',
            'amount_in_local_currency' => '...',
            'amount_in_dollars' => 'any',
            'banner' => 'anything but not image'
        ]);
        $plan->refresh();
        $this->assertNotEquals($planTitleExpected, $plan->title);
        $response->assertRedirect();
        $response->assertLocation(route('admin.teams.plans.edit', ['team' => $anotherTeam, 'plan' => $plan]));
        $response->assertSessionHasErrors(['title', 'info', 'amount_in_local_currency', 'amount_in_dollars', 'banner']);
    }
    /**@test */
    public function test_admins_can_update_team_plan_on_admin_team_plans()
    {
        $team = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $team->users()->attach($user, ['role_name' => 'app_admin']);

        $this->actingAs($user);
        session()->setPreviousUrl('/');

        $anotherTeam = factory(Team::class)->create();
        $plan = $anotherTeam->plans()->save(factory(Plan::class)->make());

        $faker = Factory::create();
        Storage::fake('s3');

        $response = $this->put(route('admin.teams.plans.update', ['team' => $anotherTeam, 'plan' => $plan]), [
            'title' => $planTitleExpected = 'lorem ipsum plan',
            'info' => 'some lorem ipsum dolor siet',
            'amount_in_local_currency' => $faker->numberBetween(100, 500),
            'amount_in_dollars' => $faker->numberBetween(100, 200),
            'banner' => UploadedFile::fake()->image('banner.jpg'),
        ]);

        $plan->refresh();
        $this->assertEquals($planTitleExpected, $plan->title);
        $response->assertRedirect();
        $response->assertLocation(route('admin.teams.plans.index', $anotherTeam));
        $response->assertSessionHas(['success']);
        Storage::disk('s3')->assertExists('plans_banners/' . basename($plan->banner));
    }
}
