<?php

namespace Tests\Feature\User\Profile;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;
    /*** @test */
    public function test_profile_form_is_visible()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get(route('profile.show'));
        $response->assertStatus(200);
    }

    public function test_profile_form_is_visible_only_for_authenticated_users()
    {
        $response = $this->get(route('profile.show'));
        $response->assertStatus(302);
    }

    public function test_unauthenticated_user_cannot_update_credentials()
    {
        $response = $this->put(route('profile.update-credentials'), [
            'name' => 'John Doe',
            'email' => 'anyTextThatIsNotEmail',
        ]);
        $response->assertRedirect(route('login'));
    }

    public function test_an_authenticated_user_can_update_profile_credentials()
    {
        $user = factory(User::class)->create([
            'name' => 'Albert Doe',
            'email' => 'albert@doe.com',
        ]);
        $this->actingAs($user);
        $response = $this->put(route('profile.update-credentials'), [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
        ]);
        $this->assertEquals('John Doe', User::first()->name);
        $response->assertSessionHas(['success']);
    }

    public function test_profile_credentials_are_required()
    {
        $user = factory(User::class)->create([
            'name' => 'Albert Doe',
            'email' => 'albert@doe.com',
        ]);
        $this->actingAs($user);
        $response = $this->put(route('profile.update-credentials'), [
            'name' => '',
            'email' => '',
        ]);
        $this->assertNotEquals('', User::first()->name);
        $this->assertNotEquals('', User::first()->email);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'email']);
    }

    public function test_user_cannot_update_credentials_without_proper_data()
    {
        $user = factory(User::class)->create([
            'name' => 'Albert Doe',
            'email' => 'albert@doe.com',
        ]);
        $this->actingAs($user);
        $response = $this->put(route('profile.update-credentials'), [
            'name' => 'John Doe',
            'email' => 'anyTextThatIsNotEmail',
        ]);
        $this->assertNotEquals('', User::first()->email);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
    }

    public function test_unautheticated_users_cannot_update_any_password()
    {
        $response = $this->put(route('profile.update-password'), [
            'name' => 'John Doe',
            'email' => 'anyTextThatIsNotEmail',
        ]);
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_update_password()
    {
        $user = factory(User::class)->create([
            'name' => 'Albert Doe',
            'email' => 'albert@doe.com',
            'password' => bcrypt(12345678),
        ]);
        $this->actingAs($user);
        $response = $this->put(route('profile.update-password'), [
            'password' => 12345678,
            'new_password' => 'laravel9',
            'new_password_confirmation' => 'laravel9'
        ]);
        $this->assertTrue(Hash::check('laravel9', User::first()->password));
        $response->assertSessionHas(['success']);
    }

    public function test_avatar_upload()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        Storage::fake('s3');
        $this->put(route('profile.update-avatar'), [
            'avatar' => UploadedFile::fake()->image('photo1.jpg'),
        ]);
        Storage::disk('s3')->assertExists('avatars/' . basename($user->avatar));
    }

    public function test_old_avatar_is_deleted_when_user_upload_a_new_avatar()
    {
        $user = factory(User::class)->create();
        $oldAvatar = $user->avatar;
        $this->actingAs($user);
        Storage::fake('s3');
        $this->put(route('profile.update-avatar'), [
            'avatar' => UploadedFile::fake()->image('photo1.jpg'),
        ]);
        Storage::disk('s3')->assertMissing('avatars/' . basename($oldAvatar));
    }
}
