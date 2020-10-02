<?php

namespace Tests\Feature\Admin\Transaction;

use App\Models\Team;
use App\Models\Transaction;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionShowTest extends TestCase
{
    /** @test */
    use RefreshDatabase;

    public function test_guests_cannot_access_to_admin_transactions_show()
    {
        session()->setPreviousUrl('/login');
        $team = factory(Team::class)->create();

        $transaction = $team->transactions()->save(factory(Transaction::class)->create());

        $response = $this->get(
            route('admin.transactions.show', [
                'transaction' => $transaction
            ])
        );
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    public function test_auth_users_but_not_team_members_cannot_access_to_transactions_show()
    {
        $this->actingAs(factory(User::class)->create());
        session()->setPreviousUrl('/login');
        $team = factory(Team::class)->create();

        $transaction = $team->transactions()->save(factory(Transaction::class)->create());

        $response = $this->get(
            route('admin.transactions.show', [
                'transaction' => $transaction
            ])
        );
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    public function test_team_admins_can_access_to_transactions_show()
    {
        $adminTeam = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $adminTeam->users()->save($user, ['role_name' => 'app_admin']);
        $this->actingAs($user);

        session()->setPreviousUrl('/login');

        $team = factory(Team::class)->create();

        $transaction = $team->transactions()->save(factory(Transaction::class)->create());

        $response = $this->get(
            route('admin.transactions.show',[
                'transaction' => $transaction
            ])
        );

        $response->assertOk();
    }
    public function test_team_transactions_show_transactions()
    {
        $adminTeam = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $adminTeam->users()->save($user, ['role_name' => 'app_admin']);
        $this->actingAs($user);

        session()->setPreviousUrl('/login');

        $team = factory(Team::class)->create();

        $transaction = $team->transactions()->save(factory(Transaction::class)->create());

        $response = $this->get(
            route('admin.transactions.show', [
                'transaction' => $transaction
            ])
        );

        $response->assertOk();

        $response->assertPropValue('transaction', function($transaction) use($team) {
            $this->assertEquals($team->transactions->first()->name, $transaction['name']);
        });
    }
}
