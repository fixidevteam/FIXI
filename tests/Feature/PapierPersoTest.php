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
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);
        $res = $this->actingAs($user)->get('my-fixi/paiperPersonnel');
        $res->assertOk();
    }
    public function test_ajouter_pp_get_notification(): void
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        // Create a user and log in
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);
        $this->actingAs($user);

        // Create a valid type in the database
        type_papierp::create([
            'type' => 'Passeport'
        ]);

        // Make the POST request
        $response = $this->post(
            'my-fixi/paiperPersonnel',
            [
                'type' => 'Passeport',
                'date_debut' => now(),
                'date_fin' => now(), // Ensure valid date range
            ]
        );
        // Assert that the response is successful
        $this->assertDatabaseHas('user_papiers', [
            'user_id' => $user->id,
        ]);

    }


}
