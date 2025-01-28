<?php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_dashboard_requires_auth_and_verified_middleware()
    {
        $response = $this->get('/fixi-plus/dashboard');
        $response->assertRedirect('/login'); // Redirect to login because the user is not authenticated
    }

    /** @test */
    public function test_authenticated_user_can_access_dashboard()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'status'=>true,
            'ville'=>'fes'
        ]);

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertStatus(200); // Assert successful access
    }
}
