<?php

namespace Tests\Feature\Admin\Transaction;

use App\Models\Team;
use App\Models\Transaction;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionUpdateTest extends TestCase
{
    /** @test */
    use RefreshDatabase;

    public function test_guests_cannot_update_a_transaction()
    {
        session()->setPreviousUrl('/login');
        $team = factory(Team::class)->create();

        $transaction = $team->transactions()->save(factory(Transaction::class)->create(['reviewed' => 'checked']));

        $response = $this->put(
            route('admin.transactions.update', [
                'transaction' => $transaction
            ]),
            [
                'reviewed' => false,
            ]
        );
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    public function test_auth_users_but_not_team_members_cannot_update_a_transaction()
    {
        $this->actingAs(factory(User::class)->create());
        session()->setPreviousUrl('/login');
        $team = factory(Team::class)->create();

        $transaction = $team->transactions()->save(factory(Transaction::class)->create(['reviewed' => 'checked']));

        $response = $this->put(
            route('admin.transactions.update', [
                'transaction' => $transaction
            ]),
            [
                'reviewed' => false,
            ]
        );
        $response->assertRedirect();
        $response->assertLocation('/login');
    }
    public function test_team_admins_can_update_a_transaction()
    {
        $adminTeam = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $adminTeam->users()->save($user, ['role_name' => 'app_admin']);
        $this->actingAs($user);

        session()->setPreviousUrl('/login');

        $team = factory(Team::class)->create();

        $transaction = $team->transactions()->save(factory(Transaction::class)->create(['reviewed' => 'pending']));

        $response = $this->put(
            route('admin.transactions.update',[
                'transaction' => $transaction
            ]),
            [
                'reviewed' => 'pending',
            ]
        );

        $response->assertRedirect();
        $response->assertLocation(route('admin.transactions.index'));
        $response->assertSessionHas(['success']);
        $this->assertEquals('checked', Transaction::first()->reviewed);
    }
    public function test_that_transaction_reviewed_can_be_updated_to_pending()
    {
        $adminTeam = factory(Team::class)->create(['name' => 'recaudar']);
        $user = factory(User::class)->create();
        $adminTeam->users()->save($user, ['role_name' => 'app_admin']);
        $this->actingAs($user);

        session()->setPreviousUrl('/login');

        $team = factory(Team::class)->create();

        $transaction = $team->transactions()->save(factory(Transaction::class)->create(['reviewed' => 'checked']));

        $response = $this->put(
            route('admin.transactions.update',[
                'transaction' => $transaction
            ]),
            [
                'reviewed' => 'checked',
            ]
        );

        $response->assertRedirect();
        $response->assertLocation(route('admin.transactions.index'));
        $response->assertSessionHas(['success']);
        $transaction->refresh();
        $this->assertEquals('pending', $transaction->reviewed);
    }
}
