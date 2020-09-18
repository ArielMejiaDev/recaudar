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

class PlanCreateTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guests_cannot_access_to_teams_plan_create()
    {
        $team = factory(Team::class)->create();
        $response = $this->get(route('teams.plans.create', $team));
        $response->assertRedirect();
    }
    /** @test */
    public function test_auth_users_but_not_team_members_cannot_access_to_teams_plan_create()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get(route('teams.plans.create', $team));
        $response->assertRedirect();
    }
    /** @test */
    public function test_members_can_access_to_teams_plan_create()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $user->teams()->attach($team);
        $response = $this->get(route('teams.plans.create', $team));
        $response->assertOk();
    }
    /** @test */
    public function test_members_cannot_store_plan_with_invalid_data()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $user->teams()->attach($team);
        Storage::fake('s3');
        $response = $this->post(route('teams.plans.store', $team), [
            'title' => '',
            'info' => 'lorem ...',
            'amount_in_local_currency' => 'any',
            'amount_in_dollars' => '...',
            'banner' => '12345678',
        ]);
        $response->assertSessionHasErrors(['title', 'info', 'amount_in_local_currency', 'amount_in_dollars', 'banner']);
    }
    /** @test */
    public function test_members_can_store_plan()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $user->teams()->attach($team);
        $faker = \Faker\Factory::create();
        Storage::fake('s3');
        $response = $this->post(route('teams.plans.store', $team), [
            'title' => $faker->text(5),
            'info' => 'lorem ipsum dolor siet lorem ...',
            'amount_in_dollars' => $amount = $faker->numberBetween(100, 500),
            'amount_in_local_currency' => ($amount * 7.5),
            'banner' => UploadedFile::fake()->image('photo1.jpg'),
        ]);
        $response->assertSessionHas(['success']);
        Storage::disk('s3')->assertExists('teams_plans_banners/' . basename(Plan::first()->banner));
    }
}
