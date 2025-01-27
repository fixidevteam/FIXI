<?php

namespace Tests\Unit;

use App\Models\garage;
use App\Models\Voiture;
use App\Models\Operation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModeleOperationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_has_correct_fillable_attributes()
    {
        $operation = new Operation();
        $this->assertEquals(
            ['categorie', 'nom', 'description', 'date_operation', 'photo', 'voiture_id', 'garage_id', 'autre_operation', 'create_by'],
            $operation->getFillable()
        );
    }

    /** @test */
    public function it_belongs_to_a_voiture()
    {
        $voiture = Voiture::factory()->create();
        $garage = garage::create(
            [
                'name' => "garage1 ",
                'ref' => 'gar-1111',
                'ville' => 'marrakech',
                'localisation' => 'marrakech',
                'services' => 'lavage'
            ]
        );
        $operation = Operation::factory()->create(['voiture_id' => $voiture->id,'garage_id'=>$garage->id]);

        $this->assertTrue($operation->voiture->is($voiture));
    }
}
