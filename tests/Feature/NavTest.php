<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NavTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_nav_items(): void
    {
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);

        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertSee('Accueil')
            ->assertSee('mes voitures')
            ->assertSee('opérations')
            ->assertSee('mes papiers personnels')
            ->assertSee('Garages partenaires')
            ->assertSee('Promotions');
        $response->assertOk();
    }
}
