<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\Garage;

class AdminGestionGarageControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test listing garages.
     */
    public function testIndexDisplaysGarages()
    {
        $admin = Admin::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
        ]);
        $garage = Garage::create([
            'name' => 'Test Garage',
            'ref' => 'G-001',
            'localisation' => 'Test Location',
        ]);

        $response = $this->actingAs($admin,'admin')->get(route('admin.gestionGarages.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.gestionGarages.index');
    }

    /**
     * Test creating a garage.
     */
    public function testStoreGarage()
    {
        $admin = Admin::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
        ]);
        $data = [
            'name' => 'New Garage',
            'ref' => 'G-002',
            'localisation' => 'New Location',
            'photo' => null,
        ];

        $response = $this->actingAs($admin,'admin')->post(route('admin.gestionGarages.store'), $data);

        $response->assertRedirect(route('admin.gestionGarages.index'));
        $this->assertDatabaseHas('garages', [
            'name' => 'New Garage',
            'ref' => 'G-002',
        ]);
    }

    // /**
    //  * Test viewing a specific garage.
    //  */
    // public function testShowGarage()
    // {
    //     $garage = Garage::create([
    //         'name' => 'Test Garage',
    //         'ref' => 'G-003',
    //         'localisation' => 'Test Location',
    //     ]);

    //     $response = $this->get(route('admin.gestionGarages.show', $garage->id));

    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.gestionGarages.show');
    //     $response->assertViewHas('garage', $garage);
    // }

    // /**
    //  * Test editing a garage.
    //  */
    // public function testEditGarage()
    // {
    //     $garage = Garage::create([
    //         'name' => 'Test Garage',
    //         'ref' => 'G-004',
    //         'localisation' => 'Test Location',
    //     ]);

    //     $response = $this->get(route('admin.gestionGarages.edit', $garage->id));

    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.gestionGarages.edit');
    //     $response->assertViewHas('garage', $garage);
    // }

    // /**
    //  * Test updating a garage.
    //  */
    // public function testUpdateGarage()
    // {
    //     $garage = Garage::create([
    //         'name' => 'Old Garage',
    //         'ref' => 'G-005',
    //         'localisation' => 'Old Location',
    //     ]);

    //     $data = [
    //         'name' => 'Updated Garage',
    //         'ref' => 'G-005',
    //         'localisation' => 'Updated Location',
    //         'photo' => UploadedFile::fake()->image('garage_updated.jpg'),
    //     ];

    //     $response = $this->put(route('admin.gestionGarages.update', $garage->id), $data);

    //     $response->assertRedirect(route('admin.gestionGarages.show', $garage->id));
    //     $this->assertDatabaseHas('garages', [
    //         'id' => $garage->id,
    //         'name' => 'Updated Garage',
    //         'ref' => 'G-005',
    //     ]);
    // }

    // /**
    //  * Test deleting a garage.
    //  */
    // public function testDestroyGarage()
    // {
    //     $garage = Garage::create([
    //         'name' => 'Garage to Delete',
    //         'ref' => 'G-006',
    //         'localisation' => 'Delete Location',
    //     ]);

    //     $response = $this->delete(route('admin.gestionGarages.destroy', $garage->id));

    //     $response->assertRedirect(route('admin.gestionGarages.index'));
    //     $this->assertDatabaseMissing('garages', ['id' => $garage->id]);
    // }
}
