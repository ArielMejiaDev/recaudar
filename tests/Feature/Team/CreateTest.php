<?php

namespace Tests\Feature\Team;

use App\User;
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
        $response = $this->post(route('teams.store'), [
            'name' => 'Doe Foundation',
            'category' => 'Salud',
            'description' => 'Doe description lorem ipsum dolor siet lorem ipsum dolor siet.',
            'public' => 'Childrens and Babies',
            'beneficiaries' => '300',
            'impact' => 'We teach development skills to around 200 childrens and 300 teenagers.',
            'legal_representative' => 'Anne Doe',
            'tax_number' => '343534533',
            'office_address' => 'Venice, Los Angeles, California',
            'use_of_funds' => 'We buy computers and technical devices to teach computer science courses.',
            'contact' => 'Mary Doe',
            'contact_phone' => '5454564645',
            'contact_email' => 'mary@doe.com',
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
            'category' => 'some random category',
            'description' => 'siet.',
            'public' => '',
            'beneficiaries' => 'text not numeric',
            'impact' => 'We',
            'legal_representative' => '2232',
            'tax_number' => 'sss',
            'office_address' => '',
            'use_of_funds' => 's.',
            'contact' => '444',
            'contact_phone' => '645',
            'contact_email' => 'marydoecomnoemail',
        ]);
        $this->assertDatabaseCount('teams', 0);
        $response->assertRedirect();
    }
}
