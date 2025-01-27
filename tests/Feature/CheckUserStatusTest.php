<?php

namespace Tests\Feature\Middleware;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckUserStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_inactive_user_is_logged_out_and_redirected_to_login()
    {
        $user = User::factory()->create(['status' => false,'ville'=>'marrakech']);

        $this->actingAs($user)
            ->get('fixi-plus/profile')
            ->assertRedirect('/login')
            ->assertSessionHasErrors([
                'email' => 'Votre compte est inactif. Veuillez contacter l\'administrateur.',
            ]);

        $this->assertGuest();
    }


}
