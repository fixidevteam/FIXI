<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Ahmed Malouni',
            'email' => 'ahmedmalouni@gmail.com',
            'telephone' => '0617824383',
            'password' => 'ahmed123',
            'password_confirmation' => 'ahmed123',
        ]);

        // Check if the registration was successful :
        $response->assertRedirect('/dashboard');

        // Check if the user was actually registered :
        $this->assertDatabaseHas('users', ['email' => 'ahmedmalouni@gmail.com']);
    }
}