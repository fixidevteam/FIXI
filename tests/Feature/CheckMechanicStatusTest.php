<?php

namespace Tests\Feature\Middleware;

use App\Models\garage;
use App\Models\Mechanic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckMechanicStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_inactive_mechanic_is_logged_out_and_redirected_to_mechanic_login()
    {
        $garage = garage::create([
            'name' => 'Garage1',
            'ville' => 'Marrakech',
            'ref' => 'GAR-12345',
            'user_id' => null,

        ]);

        // Create a mechanic associated with the garage
        $mechanic = Mechanic::create([
            'name' => 'Test Mechanic',
            'email' => 'mechanic@example.com',
            'password' => bcrypt('password'),
            'status' => false,
            'garage_id' => $garage->id, // Mechanic is linked to the garage
        ]);
        $this->actingAs($mechanic, 'mechanic')
            ->get('fixi-pro/operations')
            ->assertSessionHasErrors([
                'email' => 'Votre compte est inactif. Veuillez contacter l\'administrateur.',
            ]);

        $this->assertGuest('mechanic');
    }

    /** @test */
}
