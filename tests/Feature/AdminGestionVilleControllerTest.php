<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\Ville;
use App\Models\Quartier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminGestionVilleControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_admin_must_be_authenticated_to_access_gestion_ville_pages()
    {
        $response = $this->get(route('admin.gestionVille.index'));
        $response->assertRedirect('fp-admin/login'); // Assuming '/login' is the admin login route




        $admin = Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        Ville::create(['ville' => 'Paris']);
        Ville::create(['ville' => 'London']);

        Quartier::create(['quartier' => 'Quartier 1', 'ville_id' => 1]);
        Quartier::create(['quartier' => 'Quartier 2', 'ville_id' => 2]);

        $response = $this->actingAs($admin, 'admin')->get('fp-admin/gestionVille');

        $response->assertStatus(200);
        $response->assertViewHasAll(['villes', 'quartiers']);

        $response = $this->actingAs($admin, 'admin')->post(route('admin.gestionVille.store'), [
            'ville' => 'New Ville',
        ]);

        $response->assertRedirect(route('admin.gestionVille.index'));
        $response->assertSessionHas('success', 'Ville ajouté');
        $this->assertDatabaseHas('villes', ['ville' => 'New Ville']);

        
        $ville = Ville::create(['ville' => 'Test Ville']);

        $response = $this->actingAs($admin, 'admin')->get(route('admin.gestionVille.edit', $ville->id));

        $response->assertStatus(200);
        $response->assertViewHas('ville', $ville);


        
        $ville = Ville::create(['ville' => 'Old Ville']);

        $response = $this->actingAs($admin, 'admin')->put(route('admin.gestionVille.update', $ville->id), [
            'ville' => 'Updated Ville',
        ]);

        $response->assertRedirect(route('admin.gestionVille.index'));
        $response->assertSessionHas('success', 'Ville mise à jour');
        $this->assertDatabaseHas('villes', ['ville' => 'Updated Ville']);


             
        $ville = Ville::create(['ville' => 'Ville To Delete']);
        $ville->quartiers()->create(['quartier' => 'Quartier To Delete','ville_id'=>$ville->id]);

        $response = $this->actingAs($admin, 'admin')->delete(route('admin.gestionVille.destroy', $ville->id));

        $response->assertRedirect(route('admin.gestionVille.index'));
        $response->assertSessionHas('success', 'Ville supprimée');
    }



}