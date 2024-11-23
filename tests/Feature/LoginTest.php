<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /* 
    
    -- how to run test :  php artisan test --filter LoginTest
    -- how to run test specific method : php artisan test --filter LoginTest.test_specific_user_can_login
    
    */

    // test user if he can login to fixi 

    public function test_user_can_login()
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }
    // test specific user if he can login to fixi : 
    public function test_specific_user_can_login()
    {
        // Retrieve a specific user from the database based on their email
        $user = \App\Models\User::where('email', 'user@gmail.com')->first();

        // Ensure the user exists
        $this->assertNotNull($user);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }
}