<?php

namespace Tests\Feature\Landing;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    /** @test */
    use RefreshDatabase;
    public function test_teams_in_landing_page()
    {
        factory(Team::class)->create(['name' => 'recaudar']);
        $team = factory(Team::class)->times(3)->create();
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);
        $response->assertViewHas(['team', 'teams']);
        $response->assertViewIs('welcome');
        $response->assertSee(Team::find(1)->name);
        $response->assertSee(Team::find(2)->name);
        $response->assertSee(Team::find(3)->name);
    }
}
