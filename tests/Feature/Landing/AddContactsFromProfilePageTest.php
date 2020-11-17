<?php

namespace Tests\Feature\Landing;

use App\Models\Contact;
use App\Models\Team;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddContactsFromProfilePageTest extends TestCase
{
    use RefreshDatabase, withFaker;
    /*** @test */
    public function test_a_contact_cannot_be_added_from_profile_page_with_invalid_data()
    {
        $team = factory(Team::class)->create(['status' => 'approved']);

        $response = $this->post(
            route('add_contact_from_profile_page', $team),[
                'email' => $email = '',
            ]
        );

        $response->assertRedirect();

        $response->assertSessionHasErrors('email');
    }
    /*** @test */
    public function test_a_contact_cannot_be_added_from_profile_page_with_repeated_email()
    {
        $team = factory(Team::class)->create(['status' => 'approved']);

        Contact::create(['email' => $email = $this->faker->email, 'team_id' => $team->id]);

        $response = $this->post(
            route('add_contact_from_profile_page', $team),[
                'email' => $email,
            ]
        );

        $response->assertRedirect();

        $response->assertSessionHasErrors('email');
    }
    /*** @test */
    public function test_a_contact_can_be_added_from_profile_page()
    {
        $team = factory(Team::class)->create(['status' => 'approved']);

        $response = $this->post(
            route('add_contact_from_profile_page', $team),[
                'email' => $email = $this->faker->email,
            ]
        );

        $response->assertRedirect();

        $this->assertEquals($email, Contact::first()->email);

        $response->assertSessionHas('success');
    }
}
