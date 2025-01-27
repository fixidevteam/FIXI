<?php

namespace Tests\Unit;

use App\Models\Voiture;
use App\Models\VoiturePapier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModeleVoitureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_has_correct_fillable_attributes()
    {
        $papier = new VoiturePapier();
        $this->assertEquals(
            ['type', 'photo', 'note', 'date_debut', 'date_fin', 'voiture_id'],
            $papier->getFillable()
        );
    }

    /** @test */
    public function it_belongs_to_a_voiture()
    {
        $voiture = Voiture::factory()->create();
        $papier = VoiturePapier::factory()->create(['voiture_id' => $voiture->id]);

        $this->assertTrue($papier->voiture->is($voiture));
    }
}
