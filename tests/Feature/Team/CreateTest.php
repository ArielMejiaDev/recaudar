<?php

namespace Tests\Feature\Team;

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_guests_users_cannot_access_to_create_a_team()
    {
        $response = $this->get(route('teams.create'));
        $response->assertRedirect();
    }

    /** @test */
    public function test_auth_users_can_access_to_create_a_team()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get(route('teams.create'));
        $response->assertOk();
    }

    /** @test */
    public function test_validated_data_to_create_a_team()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $faker = Factory::create();
        $response = $this->post(route('teams.store'), [
            'name' => 'Doe Foundation',
            'beneficiaries' => '300',
            'public' => 'Childrens and Babies',
            'category' => 'Salud',
            'impact' => 'We teach development skills to around 200 childrens and 300 teenagers.',
            'use_of_funds' => 'We buy computers and technical devices to teach computer science courses.',
            'description' => 'Doe description lorem ipsum dolor siet lorem ipsum dolor siet.',
            'contact' => 'Mary Doe',
            'contact_phone' => '5454564645',
            'contact_email' => 'mary@doe.com',
            'office_address' => $faker->address,
            'legal_representative' => 'Anne Doe',
            'tax_number' => '343534533',
            'country' => 'Guatemala',
            'bank' => 'Bank of Guatemala',
            'account_number' => $faker->bankAccountNumber,
            'terms' => true,
        ]);
        $this->assertDatabaseCount('teams', 1);
    }

    /** @test */
    public function test_validated_exceptions_to_create_a_team()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->post(route('teams.store'), [
            'name' => 'Doe Foundation',
            'beneficiaries' => 'text not numeric',
            'public' => '',
            'category' => 'some random category',
            'impact' => 'We',
            'use_of_funds' => 's.',
            'description' => 'siet.',
            'contact' => '444',
            'contact_phone' => '645',
            'contact_email' => 'marydoecomnoemail',
            'office_address' => '',
            'legal_representative' => '2232',
            'tax_number' => 'sss',
            'country' => 'Any Existing Country',
            'bank' => 'any',
            'account_number' => 123,
        ]);
        $this->assertDatabaseCount('teams', 0);
        $response->assertRedirect();
    }
}
