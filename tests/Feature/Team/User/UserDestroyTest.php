<?php

namespace Tests\Feature\Team\User;

use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserDestroyTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_team_users_role_can_be_updated()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $team->users()->attach($user);

        $exampleUser = factory(User::class)->create();
        $team->users()->attach($exampleUser, ['role_name' => 'team_financial']);

        $response = $this->delete(route('teams.users.destroy', ['team' => $team, 'user' => $exampleUser]));
        $response->assertSessionHas(['warning']);
        $this->assertEquals(null, $team->users()->find($exampleUser->id));
    }
}
