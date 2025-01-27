<?php

namespace Tests\Feature;

use App\Models\Promotion;
use App\Models\User;
use App\Models\garage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Tests\TestCase;

class MechanicPromotionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_displays_active_and_expired_promotions_for_mechanics_garage()
    {
        // Create a mechanic user with a garage_id
        $garage = garage::create([
            'name' => 'Garage Mechanic',
            'ville' => 'Paris',
            'ref' => 'GAR-001',
            'user_id' => null,
        ]);

        $mechanic = User::create([
            'name' => 'Mechanic User',
            'email' => 'mechanic@example.com',
            'password' => bcrypt('password'),
            'garage_id' => $garage->id,
            'status' => true
        ]);

        // Create active promotions for the mechanic's garage
        Promotion::create([
            'nom_promotion' => 'Active Promo 1',
            'ville' => 'Paris',
            'date_debut' => now()->subDays(5),
            'date_fin' => now()->addDays(10),
            'lien_promotion' => 'https://example.com/active1',
            'garage_id' => $garage->id,
            'photo_promotion' => 'https://example.com/photo1.jpg',
            'description' => 'Active promotion 1',
        ]);


        // Create expired promotions for the mechanic's garage
        Promotion::create([
            'nom_promotion' => 'Expired Promo 1',
            'ville' => 'Paris',
            'date_debut' => now()->subDays(20),
            'date_fin' => now()->subDays(10),
            'lien_promotion' => 'https://example.com/expired1',
            'garage_id' => $garage->id,
            'photo_promotion' => 'https://example.com/photo3.jpg',
            'description' => 'Expired promotion 1',
        ]);


        // // Act as the mechanic and visit the promotions index
        // $this->actingAs($mechanic)
        //     ->get('fixi-pro/promotions/')
        //     ->assertStatus(302)
        //     ->assertViewHas('activePromotions')
        //     ->assertViewHas('expiredPromotions');
        $response = $this->actingAs($mechanic, 'mechanic')->get(route('mechanic.promotions.index'));
        $response->assertStatus(200)
            ->assertViewHas('activePromotions')
            ->assertViewHas('expiredPromotions');
    }
}
