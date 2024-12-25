<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Mockery;
use Tests\TestCase;

class ProviderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_callback_creates_new_user_and_logs_them_in()
    {
        // how to run specific method in the test file: php artisan test --filter test_callback_creates_new_user_and_logs_them_in
        // Mock the Socialite user
        $socialiteUser = Mockery::mock(SocialiteUser::class);
        $socialiteUser->shouldReceive('getId')->andReturn('12345');
        $socialiteUser->shouldReceive('getEmail')->andReturn('test@example.com');
        $socialiteUser->shouldReceive('getName')->andReturn('Test User');
        $socialiteUser->shouldReceive('token')->andReturn('mock-token');

        Socialite::shouldReceive('driver->user')->andReturn($socialiteUser);

        // Call the callback method
        $response = $this->get('/auth/callback/google');

        // Assert the user was created
        $user = User::where('email', 'test@example.com')->first();

        $this->assertNotNull($user);
        $this->assertEquals('Test User', $user->name);
        $this->assertEquals('google', $user->provider);
        $this->assertEquals('12345', $user->provider_id);
        $this->assertEquals('mock-token', $user->provider_token);

        // Assert the user is logged in
        $this->assertAuthenticatedAs($user);

        // Assert the redirection
        $response->assertRedirect('/fixi-plus/complete-profile');
    }

    public function test_callback_logs_in_existing_user_with_correct_provider()
    {
        // Create an existing user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'provider' => 'google',
            'provider_id' => '12345',
        ]);

        // Mock the Socialite user
        $socialiteUser = Mockery::mock(SocialiteUser::class);
        $socialiteUser->shouldReceive('getId')->andReturn('12345');
        $socialiteUser->shouldReceive('getEmail')->andReturn('test@example.com');

        Socialite::shouldReceive('driver->user')->andReturn($socialiteUser);

        // Call the callback method
        $response = $this->get('/auth/callback/google');

        // Assert the user is logged in
        $this->assertAuthenticatedAs($user);

        // Assert the redirection
        $response->assertRedirect('/fixi-plus/complete-profile');
    }

    public function test_callback_shows_error_for_existing_user_with_different_provider()
    {
        // Create an existing user with a different provider
        User::factory()->create([
            'email' => 'test@example.com',
            'provider' => 'facebook',
            'provider_id' => '54321',
        ]);

        // Mock the Socialite user
        $socialiteUser = Mockery::mock(SocialiteUser::class);
        $socialiteUser->shouldReceive('getId')->andReturn('12345');
        $socialiteUser->shouldReceive('getEmail')->andReturn('test@example.com');

        Socialite::shouldReceive('driver->user')->andReturn($socialiteUser);

        // Call the callback method
        $response = $this->get('/auth/callback/google');

        // Assert the user is not logged in
        $this->assertGuest();

        // Assert the error message
        $response->assertRedirect('/fixi-plus/login');
        $response->assertSessionHasErrors(['email' => 'Cette adresse email est déjà utilisée par un autre mode de connexion. Veuillez utiliser ce mode ou un autre email.']);
    }

    public function test_callback_handles_exception_and_redirects_to_login()
    {
        // Simulate an exception during the Socialite process
        Socialite::shouldReceive('driver->user')->andThrow(new \Exception('Mock exception'));

        // Call the callback method
        $response = $this->get('/auth/callback/google');

        // Assert the user is not logged in
        $this->assertGuest();

        // Assert the error message
        $response->assertRedirect('/fixi-plus/login');
        $response->assertSessionHasErrors(['error' => 'Une erreur s\'est produite lors de la connexion. Veuillez réessayer.']);
    }
}