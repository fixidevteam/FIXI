<?php

namespace Tests\Feature;

use App\Models\nom_categorie;
use App\Models\nom_operation;
use App\Models\nom_sous_operation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DataControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_returns_operations_for_a_given_category_id()
    {

       $nom_categorie = nom_categorie::create([
            'nom_categorie' => 'nom_categorie'
        ]);
        // Create operations belonging to the category
        nom_operation::create([
            'nom_operation' => 'test',
            'nom_categorie_id' => $nom_categorie->id
        ]);
        nom_operation::create([
            'nom_operation' => 'test',
            'nom_categorie_id' => $nom_categorie->id
        ]);

        $this->assertDatabaseCount('nom_operations',2);
    }

}
