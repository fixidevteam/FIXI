<?php

namespace Tests\Feature;

use App\Models\garage;
use App\Models\User;
use App\Models\Voiture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;

use Tests\TestCase;

class KmTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_kilometrage_car(): void
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
            'kilometrage'=>11999,
            'garage_id' => $garage->id
        ]);


        $this->assertDatabaseHas('operations', [
            'nom' => 'test',
            'description' => 'This is a test operation',
            'date_operation' => '2023-11-01',
            'voiture_id' => $voiture->id,
            // testin if kilometrage existe
            'kilometrage'=>11999
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('voiture.show', $voiture->id));

    }
}
