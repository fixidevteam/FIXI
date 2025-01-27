<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\nom_categorie;
use App\Models\nom_operation;
use App\Models\nom_sous_operation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminGestionSousOperationControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_admin_must_be_authenticated_to_access_sous_operations()
    {
        $response = $this->get(route('admin.gestionSousOperation.create'));
        $response->assertRedirect('fp-admin/login'); // Assuming '/login' is the admin login route


        $admin = Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        nom_categorie::create([
            'nom_categorie' => "nom_categorie"
        ]);
        nom_operation::create(['nom_operation' => 'Test Operation', 'nom_categorie_id' => 1]);

        $response = $this->actingAs($admin, 'admin')->get('fp-admin/gestionSousOperation/create');

        $response->assertStatus(200);
        $response->assertViewHas('operation', function ($operations) {
            return $operations->count() === 1;
        });


        $nom_categorie_id = nom_categorie::create(['nom_categorie' => 'nom_categorie']);
        $operation = nom_operation::create(['nom_operation' => 'Test Operation', 'nom_categorie_id' => $nom_categorie_id->id]);
        $sousOperation = nom_sous_operation::create([
            'nom_operation_id' => $operation->id,
            'nom_sous_operation' => 'Sous Operation Test',
        ]);

        $response = $this->actingAs($admin, 'admin')->get(route('admin.gestionSousOperation.edit', $sousOperation->id));
        $response->assertStatus(200);
        $response->assertViewHasAll(['operations', 'sous']);



        $nom_categorie_id = nom_categorie::create(['nom_categorie' => 'nom_categorie']);
        $operation = nom_operation::create(['nom_operation' => 'Test Operation', 'nom_categorie_id' => $nom_categorie_id->id]);

        $sousOperation = nom_sous_operation::create([
            'nom_operation_id' => 1,
            'nom_sous_operation' => $operation->id,
        ]);

        $response = $this->actingAs($admin, 'admin')->delete(route('admin.gestionSousOperation.destroy', $sousOperation->id));

        $response->assertRedirect(route('admin.gestionCategorie.index'));
        $response->assertSessionHas('success', 'Sous operation supprimée');
        $this->assertDatabaseMissing('nom_sous_operations', ['nom_sous_operation' => 'Sous Operation To Delete']);


        $nom_categorie_id = nom_categorie::create(['nom_categorie' => 'nom_categorie']);
        $operation = nom_operation::create(['nom_operation' => 'Test Operation', 'nom_categorie_id' => $nom_categorie_id->id]);
        $sousOperation = nom_sous_operation::create([
            'nom_operation_id' => $operation->id,
            'nom_sous_operation' => 'Old Sous Operation',
        ]);

        $response = $this->actingAs($admin, 'admin')->put(route('admin.gestionSousOperation.update', $sousOperation->id), [
            'nom_operation_id' => $operation->id,
            'nom_sous_operation' => 'Updated Sous Operation',
        ]);

        $response->assertRedirect(route('admin.gestionCategorie.index'));
        $response->assertSessionHas('success', 'Sous Operation mise à jour');
        $this->assertDatabaseHas('nom_sous_operations', ['nom_sous_operation' => 'Updated Sous Operation']);

    }



    /** @test */
    public function it_creates_a_new_sous_operation()
    {
        $admin = Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $nom_categorie_id = nom_categorie::create(['nom_categorie' => 'nom_categorie']);
        $operation = nom_operation::create(['nom_operation' => 'Test Operation', 'nom_categorie_id' => $nom_categorie_id->id]);

        $response = $this->actingAs($admin, 'admin')->post('fp-admin/gestionSousOperation/store', [
            'nom_operation_id' => $operation->id,
            'nom_sous_operation' => 'New Sous Operation',
        ]);

        $response->assertRedirect(route('admin.gestionCategorie.index'));
        $response->assertSessionHas('success', 'Sous operation ajouté');
        $this->assertDatabaseHas('nom_sous_operations', ['nom_sous_operation' => 'New Sous Operation']);   
    }



}
