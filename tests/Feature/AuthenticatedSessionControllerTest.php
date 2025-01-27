<?php

namespace Tests\Unit\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthenticatedSessionControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the destroy method redirects the user to the login page.
     * php artisan test --filter testDestroyMethodRedirectsToLogin
     */
    public function testDestroyMethodRedirectsToLogin(): void
    {
        // Create a user manually
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password123'),
            'telephone' => '0617824383',
            'ville' => 'Marrakech'
        ]);

        // Log in as the created user
        $this->actingAs($user);

        // Confirm the user is logged in
        $this->assertAuthenticated();

        // Perform the logout request
        $response = $this->post('/fixi-plus/logout');

        // Re-fetch the session state
        $this->refreshApplication();

        // Assert the user is logged out
        $this->assertGuest();

        // Assert redirection to the expected URL
        $response->assertRedirect('/fixi-plus/login');
    }
}