<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Voiture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VoitureControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    use WithFaker;

    public function test_user_can_create_voiture()
    {
        $this->actingAs(factory(User::class)->create());

        $data = [
            'marque' => $this->faker->word,
            'modele' => $this->faker->word,
            'date_de_première_mise_en_circulation' => now()->subDays(10)->format('Y-m-d'),
            'date_achat' => now()->subDays(5)->format('Y-m-d'),
            'date_de_dédouanement' => now()->subDays(3)->format('Y-m-d'),
            'photo' => $this->faker->image('public/storage/user/voitures', 640, 480, null, false),
        ];

        $response = $this->post('/voitures', $data);

        $response->assertStatus(302); // Check for redirect
        $this->assertDatabaseHas('voitures', ['marque' => $data['marque']]); // Validate in the database
    }

    public function test_user_can_update_voiture()
    {
        $user = User::find(1); // Assuming user ID 1 exists
        $voiture = Voiture::find(1); // Assuming voiture ID 1 exists

        $this->actingAs($user);

        $data = [
            'marque' => $this->faker->word,
            'modele' => $this->faker->word,
            'date_de_première_mise_en_circulation' => now()->subDays(10)->format('Y-m-d'),
            'date_achat' => now()->subDays(5)->format('Y-m-d'),
            'date_de_dédouanement' => now()->subDays(3)->format('Y-m-d'),
            'photo' => $this->faker->image('public/storage/user/voitures', 640, 480, null, false),
        ];

        $response = $this->put("/voitures/{$voiture->id}", $data);

        $response->assertStatus(302); // Check for redirect
        $this->assertDatabaseHas('voitures', ['marque' => $data['marque']]); // Validate in the database
    }

    public function test_user_can_delete_voiture()
    {
        $user = User::find(1); // Assuming user ID 1 exists
        $voiture = Voiture::find(1); // Assuming voiture ID 1 exists

        $this->actingAs($user);

        $response = $this->delete("/voitures/{$voiture->id}");

        $response->assertStatus(302); // Check for redirect
        $this->assertDatabaseMissing('voitures', ['id' => $voiture->id]); // Ensure the voiture is deleted
    }
}