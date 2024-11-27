<?php

namespace Tests\Feature;

use App\Models\type_papierp;
use App\Models\User;
use App\Models\UserPapier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PapierPersoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_papiers_perso(): void
    {
        $user = User::factory()->create(['status' => 1]);
        $res = $this->actingAs($user)->get('paiperPersonnel');
        $res->assertOk();
    }
    public function test_ajouter_p_p(): void
    {
        $user = User::factory()->create(['status' => 1]);
        type_papierp::create([
            'type' => 'Passeport'
        ]);
        $res = $this->actingAs($user)->post(
            '/paiperPersonnel',
            [
                'type' => 'Passeport',
                'date_debut' => now()->toDateString(),
                'date_fin' => now()->addDay()->toDateString(), // Ensure valid date range
                'user_id' => $user->id,
            ]
        );
        $res->assertOk();
    }
    public function test_supprimer_papier_perso(): void
    {
        // Arrange: Create a user and a PapierPersonnel instance
        $user = User::factory()->create(['status' => 1]);

        // Log in as the user
        $this->actingAs($user);

        // Create a PapierPersonnel record to delete
        $papierPersonnel = UserPapier::factory()->create();

        // Act: Send DELETE request to the destroy route
        $response = $this->delete('/paiperPersonnel/' . $papierPersonnel->id);

        // Assert: Check that the response status is 200 or a successful redirect (302)
        $response->assertRedirect(); // Typically, destroy routes redirect after deletion

    }
}
