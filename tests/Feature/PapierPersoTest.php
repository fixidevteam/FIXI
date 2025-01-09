<?php

namespace Tests\Feature;

use App\Models\type_papierp;
use App\Models\User;
use App\Models\UserPapier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\Undefined;
use Tests\TestCase;

class PapierPersoTest extends TestCase
{
    /**
     * A basic feature test example.
     * 
     */
    use RefreshDatabase;
    public function test_papiers_perso(): void
    {
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);
        $res = $this->actingAs($user)->get(route('paiperPersonnel.index'));
        $res->assertStatus(200);
        // $res->assertViewIs('userPaiperPersonnel.index');
    }
    public function test_undefind_type()
    {
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);
        $res = $this->actingAs($user)->post(
            route('paiperPersonnel.store'),
            [
                'type' => 'undefind',
                'date_debut' => now(),
                'date_fin' => now()
            ]
        );
        $res->assertSessionHasErrors('type');
    }
    public function test_ajouter_pp_get_notification(): void
    {
        // Create a user and log in
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);
        // Create a valid type in the database
        type_papierp::create([
            'type' => 'Passeport'
        ]);
        $response = $this->withMiddleware("CheckUserDocuments")->actingAs($user)->post(
            route('paiperPersonnel.store'),
            [
                'type' => 'Passeport',
                'date_debut' => now(),
                'date_fin' => now(), // Ensure valid date range
            ]
        );
        // Make the POST request
        $response->assertStatus(302);
        // Assert that the response is successful
        $this->assertDatabaseHas('user_papiers', [
            'user_id' => $user->id,
        ]);
        $this->assertDatabaseCount('notifications', 1);
    }
}
