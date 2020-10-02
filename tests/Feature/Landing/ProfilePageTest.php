<?php

namespace Tests\Feature\Landing;

use App\Models\Plan;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfilePageTest extends TestCase
{
    /** @test */
    use RefreshDatabase;

    public function test_profile_page_loads_with_a_team()
    {
        $team = factory(Team::class)->create();
        $team->plans()->save(factory(Plan::class)->make());
        $response = $this->get(route('profile-page', $team));
        $response->assertStatus(200);
        $defaultTheme = 'teams.themes.condensed';
        $response->assertViewIs($defaultTheme);
        $response->assertViewHas(['team']);
        $response->assertSee($team->name);
        $response->assertSee($team->plans->find(2)->title);
    }
}
