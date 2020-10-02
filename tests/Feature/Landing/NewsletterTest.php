<?php

namespace Tests\Feature\Landing;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Newsletter;
use Tests\TestCase;

class NewsletterTest extends TestCase
{
    /** @test */
    use RefreshDatabase;

    public function test_newsletter_validate_email()
    {
        $response = $this->post(route('newsletter.store'), [
            'email' => ''
        ]);
        $response->assertSessionHasErrors(['email']);
    }
    public function test_newsletter_subscribe_correct_emails()
    {
        $faker = Factory::create();
        $response = $this->post(route('newsletter.store'), [
            'email' => $email = $faker->email,
        ]);
        $response->assertSessionHas(['success']);
        Newsletter::hasMember($email);
        Newsletter::deletePermanently($email);
    }
}
