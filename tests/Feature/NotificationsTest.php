<?php

namespace Tests\Feature;

use App\Models\type_papierp;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_notifications_expired_docs(): void
    {
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);

        type_papierp::create([
            'type' => 'Passeport'
        ]);
        $response = $this->withMiddleware("CheckUserDocuments")->actingAs($user)->post(
            route('paiperPersonnel.store'),
            [
                'type' => 'Passeport',
                'date_debut' => now(),
                'date_fin' => now(), 
            ]
        );
        // Make the POST request
        $response->assertStatus(302);
        $this->assertDatabaseHas('notifications', ['notifiable_id' => $user->id]);
    }
    public function test_notifications_not_expired_docs(): void
    {
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);

        type_papierp::create([
            'type' => 'Passeport'
        ]);
        $response = $this->withMiddleware("CheckUserDocuments")->actingAs($user)->post(
            route('paiperPersonnel.store'),
            [
                'type' => 'Passeport',
                'date_debut' => '2023-08-09',
                'date_fin' => '2026-08-09', 
            ]
        );
        // Make the POST request
        $response->assertStatus(302);
        // get one notification :just  notification of confirmation 
        $this->assertDatabaseCount('notifications',1);
    }
}
