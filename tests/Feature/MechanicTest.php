<?php

namespace Tests\Unit;

use App\Models\Mechanic;
use App\Models\Garage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MechanicTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_has_correct_fillable_attributes()
    {
        $mechanic = new Mechanic();
        $this->assertEquals(
            ['name', 'email', 'password', 'garage_id', 'telephone', 'status'],
            $mechanic->getFillable()
        );
    }

    /** @test */
    public function test_it_hides_correct_attributes()
    {
        $garage = Garage::create([
            'name' => 'Garage1',
            'ville' => 'Marrakech',
            'ref' => 'GAR-12345',
            'user_id' => null,

        ]);

        // Create a mechanic associated with the garage
        $mechanic = Mechanic::create([
            'name' => 'Test Mechanic',
            'email' => 'mechanic@example.com',
            'password' => bcrypt('password'),
            'status' => 1,
            'garage_id' => $garage->id, // Mechanic is linked to the garage
        ]);
        $hiddenAttributes = $mechanic->getHidden();

        $this->assertContains('password', $hiddenAttributes);
        $this->assertContains('remember_token', $hiddenAttributes);
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

        // Create a mechanic associated with the garage
        $mechanic = Mechanic::create([
            'name' => 'Test Mechanic',
            'email' => 'mechanic@example.com',
            'password' => bcrypt('password'),
            'status' => 1,
            'garage_id' => $garage->id, // Mechanic is linked to the garage
        ]);

        $this->assertTrue($mechanic->garage->is($garage));
    }

    /** @test */

}
