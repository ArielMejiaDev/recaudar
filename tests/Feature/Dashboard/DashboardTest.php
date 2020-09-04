<?php

namespace Tests\Feature\Dashboard;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_home_page_is_not_available_for_guests()
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect();
    }

    /** @test */
    public function test_home_page_is_available_for_authenticated_users()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get(route('dashboard'));
        $response->assertOk();
    }

    public function test_home_page_show_teams()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $user->teams()->saveMany(factory(Team::class)->times(5)->make());
        $response = $this->get(route('dashboard'));
        $response->assertOk();
        $response->assertPropCount('teams', 5);
        $response->assertPropValue('teams', function($team) {
            $this->assertEquals(Team::first()->name, $team[0]['name']);
        });
    }
}
