<?php

namespace Tests\Feature\Admin\Transaction;

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

    public function test_guests_cannot_access_to_admin_transactions_index()
    {
        session()->setPreviousUrl('/login');
        $team = factory(Team::class)->create();
        $transaction = $team->transactions()->save(factory(Transaction::class)->create());
        $response = $this->get(
            route('admin.transactions.index')
        );
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    public function test_auth_users_but_not_team_members_cannot_access_to_transactions_index()
    {
        $this->actingAs(factory(User::class)->create());
        session()->setPreviousUrl('/login');
        $team = factory(Team::class)->create();
        $transaction = $team->transactions()->save(factory(Transaction::class)->create());
        $response = $this->get(
            route('admin.transactions.index')
        );
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    public function test_team_admins_can_access_to_admin_transactions_index()
    {
        $adminTeam = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $adminTeam->users()->attach($user, ['role_name' => 'app_admin']);
        $this->actingAs($user);

        session()->setPreviousUrl('/login');

        $team = factory(Team::class)->create();

        $transaction = $team->transactions()->save(factory(Transaction::class)->create());

        $response = $this->get(
            route('admin.transactions.index')
        );

        $response->assertOk();
    }
    public function test_team_transactions_index_show_admin_transactions()
    {
        $adminTeam = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $adminTeam->users()->attach($user, ['role_name' => 'app_admin']);
        $this->actingAs($user);

        session()->setPreviousUrl('/login');

        $team = factory(Team::class)->create();

        $team->transactions()->save(factory(Transaction::class)->create());

        $response = $this->get(
            route('admin.transactions.index')
        );

        $response->assertOk();
        $response->assertPropCount('transactions.data', 1);
        $team->refresh();
        $response->assertPropValue('transactions.data', function($transaction) use($team) {
            $this->assertEquals($team->transactions->first()->income, $transaction[0]['income']);
        });
    }
}
