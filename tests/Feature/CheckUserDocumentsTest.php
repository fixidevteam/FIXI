<?php

namespace Tests\Feature\Middleware;

use App\Models\type_papierp;
use App\Models\User;
use App\Models\UserPapier;
use App\Models\Voiture;
use App\Models\VoiturePapier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Carbon\Carbon;

class CheckUserDocumentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_sends_notifications_for_expiring_user_documents()
    {
        $user = User::factory()->create(['email'=>'ymofid18@gmail,com','status' => 1, 'ville' => 'marrakech']);
        // Create a valid type in the database
        type_papierp::create([
            'type' => 'Passeport'
        ]);
        $response = $this->withMiddleware("CheckUserDocuments")->actingAs($user)->post(
            route('paiperPersonnel.store'),
            [
                'type' => 'Passeport',
                'date_debut' => now(),
                'date_fin' => '2025-01-17', // Ensure valid date range
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
