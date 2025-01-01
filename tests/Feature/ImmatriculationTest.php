<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Voiture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImmatriculationTest extends TestCase
{
    use RefreshDatabase;

    public function test_ajouter_unique_voiture(): void
    {
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);

        $response = $this->actingAs($user)->post(route('voiture.store'), [
            'part1' => '123456',
            'part2' => 'أ',
            'part3' => '12',
            'marque' => 'Toyota',
            'modele' => 'Corolla',
            'photo' => null,
            'date_de_première_mise_en_circulation' => '2020-01-01',
            'date_achat' => '2022-01-01',
            'date_de_dédouanement' => '2023-01-01',
        ]);

        $response->assertRedirect(route('voiture.index'))
            ->assertSessionHas('success', 'Voiture ajoutée');

        $this->assertDatabaseHas('voitures', [
            'numero_immatriculation' => '123456-أ-12',
            'marque' => 'Toyota',
            'modele' => 'Corolla',
        ]);
    }
    public function test_ajouter_voiture_existe(): void
    {
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);
        // Create a voiture
        $voiture = Voiture::create([
            'marque' => 'Toyota',
            'modele' => 'Corolla',
            'numero_immatriculation' => '123456-أ-12',
            'user_id' => $user->id,
        ]);
        $response = $this->actingAs($user)->post(route('voiture.store'), [
            'part1' => '123456',
            'part2' => 'أ',
            'part3' => '12',
            'marque' => 'Toyota',
            'modele' => 'Corolla',
            'photo' => null,
            'date_de_première_mise_en_circulation' => '2020-01-01',
            'date_achat' => '2022-01-01',
            'date_de_dédouanement' => '2023-01-01',
        ]);

        $response->assertSessionHasErrors('numero_immatriculation');


    }
}
