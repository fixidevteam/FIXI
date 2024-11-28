<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Voiture;
use App\Models\Operation;
use App\Models\nom_categorie;
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
            'sousOperations' => ['1','1'],
        ]);


        $this->assertDatabaseHas('operations', [
            'nom' => 'Test Operation',
            'description' => 'This is a test operation',
            'voiture_id' => $voiture->id,
        ]);
    }
}
