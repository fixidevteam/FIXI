<?php

namespace Tests\Feature;

use App\Models\type_papierp;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetEmailNotificationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_get_email_notification(): void
    {
        $user = User::factory()->create(['email'=>'ymofid18@gmail.com','status' => 1, 'ville' => 'marrakech']);

        type_papierp::create([
            'type' => 'Passeport'
        ]);
        $response = $this->withMiddleware("CheckUserDocuments")->actingAs($user)->post(
            route('paiperPersonnel.store'),
            [
                'type' => 'Passeport',
                'date_debut' => now(),
                'date_fin' => '2025-01-20', 
            ]
        );
        // Make the POST request
        $response->assertStatus(302);
        $this->assertDatabaseHas('notifications', ['notifiable_id' => $user->id]);
    }
}
