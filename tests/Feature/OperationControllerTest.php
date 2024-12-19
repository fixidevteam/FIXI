<?php

namespace Tests\Feature;

use App\Models\garage;
use App\Models\User;
use App\Models\Voiture;
use App\Models\Operation;
use App\Models\nom_categorie;
use App\Models\nom_operation;
use App\Models\nom_sous_operation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class OperationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_operation_without_autre(): void
    {
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);


        $voiture = Voiture::create([
            'marque' => 'Toyota',
            'modele' => 'Corolla',
            'numero_immatriculation' => '123-أ-45',
            'user_id' => $user->id,
        ]);
        $garage = garage::create(
            [
                'name' => "garage1 ",
                'ref' => 'gar-1111',
                'ville' => 'marrakech',
                'localisation' => 'marrakech',
                'services' => 'lavage'
            ]
        );
        Session::put('voiture_id', $voiture->id);

        $response = $this->actingAs($user)->post(route('operation.store'), [
            'categorie' => 'category',
            'nom' => 'test',
            'description' => 'This is a test operation',
            'date_operation' => '2023-11-01',
            'garage_id' => $garage->id
        ]);


        $this->assertDatabaseHas('operations', [
            'nom' => 'test',
            'description' => 'This is a test operation',
            'date_operation' => '2023-11-01',
            'voiture_id' => $voiture->id,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('voiture.show', $voiture->id));
    }
    public function test_create_operation_with_autre(): void
    {
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);


        $voiture = Voiture::create([
            'marque' => 'Toyota',
            'modele' => 'Corolla',
            'numero_immatriculation' => '123-أ-45',
            'user_id' => $user->id,
        ]);
        $garage = garage::create(
            [
                'name' => "garage1 ",
                'ref' => 'gar-1111',
                'ville' => 'marrakech',
                'localisation' => 'marrakech',
                'services' => 'lavage'
            ]
        );
        Session::put('voiture_id', $voiture->id);

        $response = $this->actingAs($user)->post(route('operation.store'), [
            'categorie' => 'category',
            'nom' => 'autre',
            'autre_operation' => 'test',
            'description' => 'This is a test operation',
            'date_operation' => '2023-11-01',
            'garage_id' => $garage->id
        ]);


        $this->assertDatabaseHas('operations', [
            'nom' => 'autre',
            'autre_operation' => 'test',
            'description' => 'This is a test operation',
            'date_operation' => '2023-11-01',
            'voiture_id' => $voiture->id,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('voiture.show', $voiture->id));
    }
    /**
     * Test list of operations.
     */
    public function test_operation_list()
    {
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);

        $response = $this->actingAs($user)->get(route('operation.index'));
        $response->assertViewIs('userOperations.index');
    }
    /**
     * Test the show method for a valid operation.
     */
    public function test_show_operation_with_valid_id(): void
    {
        // Create a user
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);

        // Create a voiture
        $voiture = Voiture::create([
            'marque' => 'Toyota',
            'modele' => 'Corolla',
            'numero_immatriculation' => '123-أ-45',
            'user_id' => $user->id,
        ]);

        // Create some related data for nom_categorie
        $categorie1 = nom_categorie::create(['nom_categorie' => "Services d'un garage mécanique"]);

        // Create nom_operation linked to categories
        $operation1 = nom_operation::create([
            'nom_operation' => 'Réparation de moteur',
            'nom_categorie_id' => $categorie1->id, // Link to "Services d'un Garage Mécanique"
        ]);

        // Create an operation linked to the voiture
        $operation = Operation::create([
            'categorie' => $categorie1->id,
            'nom' => $operation1,
            'description' => 'This is a test operation',
            'date_operation' => '2023-11-01',
            'photo' => null,
            'voiture_id' => $voiture->id,
            'garage_id' => null,
        ]);

        // Act as the user and request 
        $response = $this->actingAs($user)->get(route('voiture.show', $voiture->id));

        // Assert the view is returned with correct data
        $response->assertStatus(200);
        $response->assertViewIs('userCars.show');
    }
    /**
     * Test the show method with an invalid operation ID.
     */
    public function test_show_operation_with_invalid_id(): void
    {
        // Create a user
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);

        // Create a voiture
        $voiture = Voiture::create([
            'marque' => 'Toyota',
            'modele' => 'Corolla',
            'numero_immatriculation' => '123-أ-45',
            'user_id' => $user->id,
        ]);

        // Act as the user
        $this->actingAs($user);

        // Attempt to show an operation that doesn't exist
        $response = $this->get(route('operation.show', 999)); // Non-existent ID

        // Assert the response status
        $response->assertStatus(403); // Forbidden due to invalid ID
    }
}
