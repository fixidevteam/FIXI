<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class villeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_register_fails_without_ville()
    {
        $this->withoutMiddleware(); // Disable all middleware for this test

        // Make a POST request to the store function without 'ville'
        $response = $this->post(route('register'), [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'telephone' => '+212612345678',
            // 'ville' is intentionally left out to test validation
        ]);

        // Assert that the response has a 302 status (redirect due to validation error)
        $response->assertStatus(302);

        // Assert that the session has validation errors for 'ville'
        $response->assertSessionHasErrors(['ville']);
    }
}
