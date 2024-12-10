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

    /**
     * Test to create a new operation.
     */
    public function test_create_operation(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
            'status' => 1,
        ]);

        $voiture = Voiture::create([
            'marque' => 'Toyota',
            'modele' => 'Corolla',
            'numero_immatriculation' => '123-أ-45',
            'user_id' => $user->id,
        ]);

        Session::put('voiture_id', $voiture->id);

        $response = $this->actingAs($user)->post(route('operation.store'), [
            'categorie' => 'category',
            'nom' => 'Test Operation',
            'description' => 'This is a test operation',
            'date_operation' => '2023-11-01',
            'sousOperations' => ['1', '1'],
        ]);


        $this->assertDatabaseHas('operations', [
            'nom' => 'Test Operation',
            'description' => 'This is a test operation',
            'voiture_id' => $voiture->id,
        ]);
    }
    /**
     * Test list of operations.
     */
    public function test_list_operations()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
            'status' => 1,
        ]);
        $response = $this->actingAs($user)->get(route('operation.index'));
        $response->assertStatus(200);
    }
    /**
     * Test the show method for a valid operation.
     */
    public function test_show_operation_with_valid_id(): void
    {
        // Create a user
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
            'status' => 1, // Active user
        ]);

        // Create a voiture
        $voiture = Voiture::create([
            'marque' => 'Toyota',
            'modele' => 'Corolla',
            'numero_immatriculation' => '123-أ-45',
            'user_id' => $user->id,
        ]);

        // Create some related data for nom_categorie
        $categorie1 = nom_categorie::create(['nom_categorie' => "Services d'un garage mécanique"]);
        $categorie2 = nom_categorie::create(['nom_categorie' => "Services d'un garage de lavage"]);
        $categorie3 = nom_categorie::create(['nom_categorie' => "Services d'un garage de carrosserie"]);
        $categorie4 = nom_categorie::create(['nom_categorie' => "Services d'un garage pneumatique"]);

        // Create nom_operation linked to categories
        $operation1 = nom_operation::create([
            'nom_operation' => 'Réparation de moteur',
            'nom_categorie_id' => $categorie1->id, // Link to "Services d'un Garage Mécanique"
        ]);

        $operation2 = nom_operation::create([
            'nom_operation' => 'Entretien et vidange',
            'nom_categorie_id' => $categorie1->id, // Link to "Services d'un Garage Mécanique"
        ]);

        // Create nom_sous_operation linked to operations
        nom_sous_operation::create([
            'nom_sous_operation' => 'Remplacement des filtres à huile',
            'nom_operation_id' => $operation1->id,
        ]);

        nom_sous_operation::create([
            'nom_sous_operation' => 'Remplacement des filtres à carburant',
            'nom_operation_id' => $operation1->id,
        ]);

        // Create an operation linked to the voiture
        $operation = Operation::create([
            'categorie' => $categorie1->id,
            'nom' => $operation2->id,
            'description' => 'This is a test operation',
            'date_operation' => '2023-11-01',
            'photo' => null,
            'voiture_id' => $voiture->id,
            'garage_id' => null,
        ]);

        // Act as the user and request the show route
        $response = $this->actingAs($user)->get(route('operation.show', $operation->id));

        // Assert the view is returned with correct data
        $response->assertStatus(200);
        $response->assertViewIs('userOperations.show');
        $response->assertViewHasAll([
            'voiture' => $voiture,
            'operation' => $operation,
            'operations',
            'categories',
            'sousOperation',
        ]);
    }
    /**
     * Test the show method with an invalid operation ID.
     */
    public function test_show_operation_with_invalid_id(): void
    {
        // Create a user
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
            'status' => 1,
        ]);
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