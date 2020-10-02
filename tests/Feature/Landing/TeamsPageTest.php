<?php

namespace Tests\Feature\Landing;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\Paginator;
use Tests\TestCase;

class TeamsPageTest extends TestCase
{
    const DEFAULT_PAGINATION_PER_PAGE = 3;

    /** @test */
    use RefreshDatabase;
    public function test_teams_page_load_with_data()
    {
        factory(Team::class)->times(20)->create();

        $response = $this->get(route('teams-page'));
        $response->assertStatus(200);
        $response->assertViewIs('teams-page');
        $response->assertViewHas(['teams']);
        Team::limit(self::DEFAULT_PAGINATION_PER_PAGE)->get()->each(fn($team) => $response->assertSee($team->name));
    }
}
