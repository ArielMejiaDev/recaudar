<?php

namespace Tests\Feature\Team\Transaction;

use App\Models\Team;
use App\Models\Transaction;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionIndexTest extends TestCase
{
    /** @test */
    use RefreshDatabase;

    public function test_guests_cannot_access_to_transactions_index()
    {
        session()->setPreviousUrl('/login');
        $team = factory(Team::class)->create();
        $transaction = $team->transactions()->save(factory(Transaction::class)->create());
        $response = $this->get(
            route('teams.transactions.index', $team)
        );
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    public function test_auth_users_but_not_team_members_cannot_access_to_team_transactions_index()
    {
        $this->actingAs(factory(User::class)->create());
        session()->setPreviousUrl('/login');
        $team = factory(Team::class)->create();
        $transaction = $team->transactions()->save(factory(Transaction::class)->create());
        $response = $this->get(
            route('teams.transactions.index', $team)
        );
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    public function test_team_admins_can_access_to_team_transactions_index()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        session()->setPreviousUrl('/login');

        $team = factory(Team::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);

        $transaction = $team->transactions()->save(factory(Transaction::class)->create());

        $response = $this->get(
            route('teams.transactions.index', $team)
        );

        $response->assertOk();
    }
    public function test_team_transactions_index_show_transactions()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        session()->setPreviousUrl('/login');

        $team = factory(Team::class)->create();
        $team->users()->attach($user, ['role_name' => 'team_admin']);

        $team->transactions()->save(factory(Transaction::class)->create());

        $response = $this->get(
            route('teams.transactions.index', $team)
        );

        $response->assertOk();
        $response->assertPropCount('transactions.data', 1);
        $team->refresh();
        $response->assertPropValue('transactions.data', function($transaction) use($team) {
            $this->assertEquals($team->transactions->first()->name, $transaction[0]['name']);
        });
    }
}
