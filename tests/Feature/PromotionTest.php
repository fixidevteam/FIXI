<?php

namespace Tests\Unit;

use App\Models\Promotion;
use App\Models\Garage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PromotionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_has_correct_fillable_attributes()
    {
        $promotion = new Promotion();
        $this->assertEquals(
            ['nom_promotion', 'ville', 'date_debut', 'date_fin', 'lien_promotion', 'garage_id', 'photo_promotion', 'description'],
            $promotion->getFillable()
        );
    }

    /** @test */
    public function test_it_belongs_to_a_garage()
    {
        $garage = Garage::create([
            'name' => 'Garage1',
            'ville' => 'Marrakech',
            'ref' => 'GAR-12345',
            'user_id' => null,

        ]);

        $promotion = Promotion::create([
            'nom_promotion'=>'promotion',
        'ville'=>'fes',
        'date_debut'=>now(),
        'date_fin'=>'2026-01-01',
        'lien_promotion'=>"https://web.whatsapp.com/",
        'garage_id'=>$garage->id,
        'photo_promotion'=>'https://web.whatsapp.com/',
        'description'=>'test',
        ]);

        $this->assertTrue($promotion->garage->is($garage));
    }
}
