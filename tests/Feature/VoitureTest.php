<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Voiture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VoitureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to view the voiture index page.
     */
    public function test_voiture_index(): void
    {
        $user = User::factory()->create(['status' => 1]);

        $response = $this->actingAs($user)->get(route('voiture.index'));
        $response->assertStatus(200)
                 ->assertViewIs('userCars.index');
    }

    /**
     * Test to add a new voiture.
     */
    public function test_ajouter_voiture(): void
    {
        $user = User::factory()->create(['status' => 1]);

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

    /**
     * Test to update an existing voiture.
     */
    public function test_modifier_voiture(): void
    {
        $user = User::factory()->create(['status' => 1]);
        $voiture = Voiture::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put(route('voiture.update', $voiture->id), [
            'part1' => '654321',
            'part2' => 'ب',
            'part3' => '21',
            'marque' => 'Honda',
            'modele' => 'Civic',
            'photo' => null,
            'date_de_première_mise_en_circulation' => '2019-01-01',
            'date_achat' => '2021-01-01',
            'date_de_dédouanement' => '2022-01-01',
        ]);

        $response->assertRedirect(route('voiture.index'))
                 ->assertSessionHas('success', 'Voiture mise à jour');

        $this->assertDatabaseHas('voitures', [
            'numero_immatriculation' => '654321-ب-21',
            'marque' => 'Honda',
            'modele' => 'Civic',
        ]);
    }

    /**
     * Test to delete a voiture.
     */
    public function test_supprimer_voiture(): void
    {
        $user = User::factory()->create(['status' => 1]);
        $voiture = Voiture::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete(route('voiture.destroy', $voiture->id));

        $response->assertRedirect(route('voiture.index'))
                 ->assertSessionHas('success', 'Voiture supprimée');

    }

}
