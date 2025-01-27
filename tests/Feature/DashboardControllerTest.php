<?php

namespace Tests\Feature;

use App\Models\garage;
use App\Models\Promotion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_retrieves_promotions_based_on_user_ville_and_date_fin()
    {
        $user = User::factory()->create(['ville' => 'Paris', 'status' => true]);

        $garage = garage::create([
            'name' => 'Garage1',
            'ville' => 'Marrakech',
            'ref' => 'GAR-12345',
            'user_id' => null,

        ]);

        $promotion = Promotion::create([
            'nom_promotion' => 'promotion',
            'ville' => 'fes',
            'date_debut' => now(),
            'date_fin' => '2026-01-01',
            'lien_promotion' => "https://web.whatsapp.com/",
            'garage_id' => $garage->id,
            'photo_promotion' => 'https://web.whatsapp.com/',
            'description' => 'test',
        ]);

        $this->actingAs($user)
            ->get('fixi-plus/dashboard') // Assuming your route is named 'dashboard.index'
            ->assertStatus(200)
            ->assertViewHas('promotions');
    }

    
}
