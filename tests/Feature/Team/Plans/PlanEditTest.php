<?php

namespace Tests\Feature\Team\Plans;

use App\Models\Plan;
use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PlanEditTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guests_cannot_access_to_teams_plan_edit()
    {
        $team = factory(Team::class)->create();
        $plan = factory(Plan::class)->create();
        $team->plans()->attach($plan);
        $response = $this->get(route('teams.plans.edit', ['team' => $team, 'plan' => $plan]));
        $response->assertRedirect();
    }
    /** @test */
    public function test_auth_users_but_not_team_members_cannot_access_to_teams_plan_edit()
    {
        $team = factory(Team::class)->create();
        $plan = factory(Plan::class)->create();
        $team->plans()->attach($plan);
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get(route('teams.plans.edit', ['team' => $team, 'plan' => $plan]));
        $response->assertRedirect();
    }
    /** @test */
    public function test_members_can_access_to_teams_plan_edit()
    {
        $team = factory(Team::class)->create();
        $plan = factory(Plan::class)->create();
        $team->plans()->attach($plan);
        $user = factory(User::class)->create();
        $user->teams()->attach($team);
        $this->actingAs($user);
        $response = $this->get(route('teams.plans.edit', ['team' => $team, 'plan' => $plan]));
        $response->assertOk();
    }
    /** @test */
    public function test_members_cannot_update_plan_with_invalid_data()
    {
        $team = factory(Team::class)->create();
        $plan = factory(Plan::class)->create();
        $team->plans()->attach($plan);
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $user->teams()->attach($team);

        Storage::fake('s3');

        $response = $this->put(route('teams.plans.update', ['team' => $team, 'plan' => $plan]), [
            'title' => '',
            'info' => 'lorem ...',
            'amount_in_local_currency' => 'random text',
            'amount_in_dollars' => 'any',
            'banner' => '12345678',
        ]);

        $response->assertSessionHasErrors(['title', 'info', 'amount_in_local_currency', 'amount_in_dollars', 'banner']);
    }
    /** @test */
    public function test_members_can_store_plan()
    {
        $team = factory(Team::class)->create();
        $plan = factory(Plan::class)->create();
        $team->plans()->attach($plan);
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $user->teams()->attach($team);

        $faker = \Faker\Factory::create();
        Storage::fake('s3');

        $response = $this->put(route('teams.plans.update', ['team' => $team, 'plan' => $plan]), [
            'title' => 'An awesome Plan title',
            'info' => 'lorem ipsum dolor siet lorem ...',
            'amount_in_dollars' => $amount =$faker->numberBetween(100, 800),
            'amount_in_local_currency' => ($amount * 7.5),
            'banner' => UploadedFile::fake()->image('photo1.jpg'),
        ]);
        $response->assertSessionHas(['success']);
        $plan->refresh();
        $this->assertEquals('An awesome Plan title', $plan->title);
        Storage::disk('s3')->assertExists('teams_plans_banners/' . basename(Plan::first()->banner));
    }
}
