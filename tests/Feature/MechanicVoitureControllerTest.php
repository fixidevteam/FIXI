<?php

namespace Tests\Feature;

use App\Models\Garage;
use App\Models\Mechanic;
use App\Models\Operation;
use App\Models\User;
use App\Models\Voiture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class MechanicVoitureControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to get the list of voitures associated with the mechanic's garage.
     */
    public function test_get_voitures_for_mechanic(): void
    {
        // Create a garage
        $garage = Garage::create([
            'name' => 'Test Garage',
            'ref' => '1212',
        ]);

        // Create a mechanic associated with the garage
        $mechanic = Mechanic::create([
            'name' => 'Test Mechanic',
            'email' => 'mechanic@example.com',
            'password' => bcrypt('password'),
            'status' => 1,
            'garage_id' => $garage->id, // Mechanic is linked to the garage
        ]);

        // Create a client and their voiture
        $client = User::create([
            'name' => 'Test Client',
            'email' => 'client@example.com',
            'password' => bcrypt('password'),
        ]);

        $voiture = Voiture::create([
            'marque' => 'Toyota',
            'modele' => 'Corolla',
            'numero_immatriculation' => '123-أ-45',
            'user_id' => $client->id,
        ]);

        // Create an operation linked to the garage
        Operation::create([
            'categorie' => 'Maintenance',
            'nom' => 'Oil Change',
            'description' => 'Routine oil change',
            'date_operation' => now(),
            'voiture_id' => $voiture->id,
            'garage_id' => $garage->id,
        ]);

        // Authenticate as the mechanic
        $response = $this->actingAs($mechanic, 'mechanic')->get(route('mechanic.voitures.index'));

        // Assert the response
        $response->assertStatus(200)
                 ->assertViewIs('mechanic.voitures.index');

    }

    /**
     * Test to view a specific voiture's details.
     */
    public function test_view_voiture_details_for_mechanic(): void
    {
        // Create a garage
        $garage = Garage::create([
            'name' => 'Test Garage',
            'ref' => '1212',
        ]);

        // Create a mechanic associated with the garage
        $mechanic = Mechanic::create([
            'name' => 'Test Mechanic',
            'email' => 'mechanic@example.com',
            'password' => bcrypt('password'),
            'status' => 1,
            'garage_id' => $garage->id, // Mechanic is linked to the garage
        ]);

        // Create a client and their voiture
        $client = User::create([
            'name' => 'Test Client',
            'email' => 'client@example.com',
            'password' => bcrypt('password'),
        ]);

        $voiture = Voiture::create([
            'marque' => 'Toyota',
            'modele' => 'Corolla',
            'numero_immatriculation' => '123-أ-45',
            'user_id' => $client->id,
        ]);

        // Create an operation linked to the garage
        Operation::create([
            'categorie' => 'Maintenance',
            'nom' => 'Oil Change',
            'description' => 'Routine oil change',
            'date_operation' => now(),
            'voiture_id' => $voiture->id,
            'garage_id' => $garage->id,
        ]);

        // Authenticate as the mechanic and view the voiture
        $response = $this->actingAs($mechanic, 'mechanic')->get(route('mechanic.voitures.show', $voiture->id));

        // Assert the response
        $response->assertStatus(200);
    }

    /**
     * Test unauthorized mechanic trying to view a voiture.
     */
}
