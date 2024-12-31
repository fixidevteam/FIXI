<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class FomraTelTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('fixi-plus/register');

        $response->assertStatus(200);
    }
    public function testCorrectTel(): void
    {
        $response = $this->post('fixi-plus/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'telephone'=>'0777524189',
            'ville'=>'marrakech',
        ]);
        $response->assertSessionHasNoErrors();

    }
    public function testIncorrectTel(): void
    {
        $response = $this->post('fixi-plus/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'telephone' => '0577527167', // Invalid telephone
            'ville' => 'marrakech',
            'password_confirmation' => 'password',
        ]);
    
        $response->assertSessionHasErrors(['telephone']); // Assert validation error for 'telephone'
        $this->assertGuest(); // Ensure the user is not authenticated
    }
    

}
