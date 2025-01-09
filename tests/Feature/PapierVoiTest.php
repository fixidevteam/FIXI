<?php

namespace Tests\Feature;

use App\Models\type_papierv;
use App\Models\User;
use App\Models\Voiture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PapierVoiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_papiervoi_index(): void
    {
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);

        $response = $this->actingAs($user)->get(route('documentVoiture.index'));

        $response->assertViewIs('userDocumentVoiture.index');
    }
    public function test_papiervoi_create(): void
    {
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);

        $response = $this->actingAs($user)->get(route('documentVoiture.create'));

        $response->assertStatus(200);
    }
    public function test_papiervoi_store(): void
    {
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);
        type_papierv::create([
            'type' => 'permis'
        ]);
        $voiture = Voiture::create([

            'marque' => 'Toyota',
            'modele' => 'Corolla',
            'numero_immatriculation' => '123-أ-45',
            'user_id' => $user->id,
        ]);
        $response = $this->actingAs($user)->post(route(
            'documentVoiture.store',
            [
                'type' => 'permis',
                'date_debut' => '2024-11-08',
                'date_fin' => '2025-01-09',
                'voiture_id' => $voiture->id,
            ]
        ));

        $response->assertStatus(302);
        $response->assertRedirectToRoute('documentVoiture.index');
    }
}
