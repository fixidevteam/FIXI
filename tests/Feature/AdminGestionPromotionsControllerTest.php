<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\Garage;
use App\Models\Promotion;
use App\Models\Ville;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Http\UploadedFile as HttpUploadedFile;


class AdminGestionPromotionsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_must_be_authenticated_to_access_promotions()
    {
        $admin = Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $ville = Ville::create(['ville' => 'Paris']);
        $garage = Garage::create([
            'name' => 'Garage 1',
            'ville' => 'Paris',
            'ref' => 'GAR-001',
            'user_id' => null,
        ]);
        $Promotion = Promotion::create([
            'nom_promotion' => 'Promo 1',
            'ville' => 'Paris',
            'date_debut' => now(),
            'date_fin' => now()->addDays(10),
            'lien_promotion' => 'https://example.com/promo1',
            'garage_id' => $garage->id,
            'photo_promotion' => 'https://example.com/photo1.jpg',
            'description' => 'Promotion 1 description',
        ]);
        $response = $this->get(route('admin.gestionPromotions.index'));
        $response->assertRedirect('fp-admin/login'); // Assuming '/login' is the admin login route

        // index;
        $response = $this->actingAs($admin, 'admin')->get(route('admin.gestionPromotions.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.gestionPromotions.index');
        $response->assertViewHas('promotions');
        // create 
        $response = $this->actingAs($admin, 'admin')->get(route('admin.gestionPromotions.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.gestionPromotions.create');
        $response->assertViewHas('villes');
        $response->assertViewHas('garages');
        // store
        $file = UploadedFile::fake()->image('photo.jpg');
        $response = $this->actingAs($admin, 'admin')->post(route('admin.gestionPromotions.store'), [
            'nom_promotion' => 'New Promotion',
            'ville' => 'Paris',
            'date_debut' => now()->subDays(1)->toDateString(),
            'date_fin' => now()->addDays(5)->toDateString(),
            'lien_promotion' => 'https://example.com/new',
            'garage_id' => $garage->id,
            'description' => 'Test description',
            'photo_promotion' => $file,
        ]);
        $response->assertRedirect(route('admin.gestionPromotions.index'));
        $response->assertSessionHas('success', 'Promotion ajoutée');
        $response->assertSessionHas('subtitle', 'La promotion a été ajoutée avec succès.');
        // show
        $response = $this->actingAs($admin, 'admin')->get(route('admin.gestionPromotions.show', $Promotion->id));
        $response->assertStatus(200);
        $response->assertViewIs('admin.gestionPromotions.show');
        $response->assertViewHas('promotion');
        // edit
        $response = $this->actingAs($admin, 'admin')->get(route('admin.gestionPromotions.edit', $Promotion->id));
        $response->assertStatus(200);
        $response->assertViewIs('admin.gestionPromotions.edit');
        $response->assertViewHas('promotion');
        $response->assertViewHas('villes');
        $response->assertViewHas('garages');
        // destroy
        $response = $this->actingAs($admin, 'admin')->delete(route('admin.gestionPromotions.destroy', $Promotion->id));
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.gestionPromotions.index'));
        $response->assertSessionHas('success');
    }
}
