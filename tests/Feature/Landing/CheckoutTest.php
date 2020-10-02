<?php

namespace Tests\Feature\Landing;

use App\Mail\DonationThanks;
use App\Models\Charge;
use App\Models\Plan;
use App\Models\Team;
use App\Models\Transaction;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    /** @test */
    use RefreshDatabase;
    public function test_checkout_payment_validation()
    {
        $team = factory(Team::class)->create();
        $plan = $team->plans()->save(factory(Plan::class)->make());
        $route = route('pay', ['team' => $team, 'plan' => $plan]);
        $faker = Factory::create();
        $response = $this->post($route,  [
            'email' => '',
            'name' => 123,
            'card' => 1111,
            'date' => '',
            'cvc' => '',
            'currency' => '',
            'amount' => '',
            'recurrence' => 'SOMETEXT',
            'deviceFingerprintID' => ''
        ]);
        $response->assertSessionHasErrors(['email', 'name', 'card', 'date', 'cvc', 'currency', 'amount', 'recurrence', 'deviceFingerprintID']);
    }
    public function test_checkout_payment_can_pay_with_a_plan()
    {
        $team = factory(Team::class)->create(['country' => 'Guatemala']);
        factory(Charge::class)->create(['gateway' => 'pagalogt', 'country' => $team->country]);
        $plan = $team->plans()->save(factory(Plan::class)->make(['amount_in_local_currency' => 90.00]));
        $route = route('pay', ['team' => $team, 'plan' => $plan]);
        $faker = Factory::create();
        $response = $this->post($route,  [
            'email' => $faker->email,
            'name' => $faker->name,
            'card' => '123456789123',
            'date' => '02/22',
            'cvc' => 123,
            'currency' => 'GTQ',
            'amount' => $plan->amount_in_local_currency,
            'recurrence' => true,
            'deviceFingerprintID' => '1601630963406'
        ]);
        $response->assertSessionHasNoErrors();
        $this->assertEquals(
            route('certificate', [
                'team' => $team,
                'transaction' => Transaction::first(),
            ]),
            $response->json('redirect'),
        );
        $this->assertEquals($plan->amount_in_local_currency, number_format(Transaction::first()->amount, 2));
    }
    public function test_checkout_payment_can_pay_with_variable_amount()
    {
        $team = factory(Team::class)->create(['country' => 'Guatemala']);
        factory(Charge::class)->create(['gateway' => 'pagalogt', 'country' => $team->country]);
        $plan = $team->plans()->save(factory(Plan::class)->make());
        $route = route('pay', ['team' => $team, 'plan' => $plan]);
        $faker = Factory::create();
        $response = $this->post($route,  [
            'email' => $faker->email,
            'name' => $faker->name,
            'card' => '123456789123',
            'date' => '02/22',
            'cvc' => 123,
            'currency' => 'GTQ',
            'amount' => 100.00,
            'recurrence' => true,
            'deviceFingerprintID' => '1601630963406'
        ]);
        $response->assertSessionHasNoErrors();
        $this->assertEquals(
            route('certificate', [
                'team' => $team,
                'transaction' => Transaction::first(),
            ]),
            $response->json('redirect'),
        );
        $this->assertEquals(100.00, number_format(Transaction::first()->amount, 2));
    }
    public function test_email_was_send_when_checkout_payment_is_successful()
    {
        $team = factory(Team::class)->create(['country' => 'Guatemala']);
        factory(Charge::class)->create(['gateway' => 'pagalogt', 'country' => $team->country]);
        $plan = $team->plans()->save(factory(Plan::class)->make());
        $route = route('pay', ['team' => $team, 'plan' => $plan]);
        $faker = Factory::create();

        Mail::fake();

        $response = $this->post($route,  [
            'email' => $email = $faker->email,
            'name' => $name = $faker->name,
            'card' => '123456789123',
            'date' => '02/22',
            'cvc' => 123,
            'currency' => 'GTQ',
            'amount' => 100.00,
            'recurrence' => true,
            'deviceFingerprintID' => '1601630963406'
        ]);
        $response->assertSessionHasNoErrors();
        $this->assertEquals(
            route('certificate', [
                'team' => $team,
                'transaction' => Transaction::first(),
            ]),
            $response->json('redirect'),
        );
        $this->assertEquals(100.00, number_format(Transaction::first()->amount, 2));
        Mail::assertSent(DonationThanks::class, function ($mail) use ($name, $email) {
            return $mail->hasTo($email);
        });
    }
    public function test_transaction_is_saved_as_failed_transaction_if_payment_request_fail()
    {
        $team = factory(Team::class)->create(['country' => 'Guatemala']);
        factory(Charge::class)->create(['gateway' => 'pagalogt', 'country' => $team->country]);
        $plan = $team->plans()->save(factory(Plan::class)->make());
        $route = route('pay', ['team' => $team, 'plan' => $plan]);
        $faker = Factory::create();

        Config::set('pagalogt.test.iden_empresa', '');

        $response = $this->post($route,  [
            'email' => $email = $faker->email,
            'name' => $name = $faker->name,
            'card' => '123456789123',
            'date' => '02/22',
            'cvc' => 123,
            'currency' => 'GTQ',
            'amount' => 100.00,
            'recurrence' => true,
            'deviceFingerprintID' => '1601630963406'
        ]);

        $response->assertSessionHasErrors(['transaction']);
        $this->assertEquals('fail', Transaction::first()->status);
    }
}
