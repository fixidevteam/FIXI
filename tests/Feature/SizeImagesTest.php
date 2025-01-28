<?php

namespace Tests\Feature;
use App\Models\type_papierp;
use App\Models\User;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile as HttpUploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SizeImagesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_size_images_more_than_5mb(): void
    {
        // Fake the storage for testing
        Storage::fake('public');
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);
        $photo = HttpUploadedFile::fake()->image('fixiRepair.jpg')->size(8024); // 5000 KB (5 MB)
        $type = type_papierp::create(['type' => 'Pass']);
        $res = $this->actingAs($user)->post('fixi-plus/paiperPersonnel', [
            'type' => 'Pass',
            'note' => 'notes',
            'photo' => $photo,
            'date_debut' => now(),
            'date_fin' => now(),
        ]);
        $res->assertSessionHasErrors('photo');
    }
    
    public function test_size_images_less_than_5mb(): void
    {
        // Fake the storage for testing
        Storage::fake('public');
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);
        $photo = HttpUploadedFile::fake()->image('fixiRepair.jpg')->size(1024); // 5000 KB (5 MB)
        $type = type_papierp::create(['type' => 'Pass']);
        $res = $this->actingAs($user)->post('fixi-plus/paiperPersonnel', [
            'type' => 'Pass',
            'note' => 'notes',
            'photo' => $photo,
            'date_debut' => now(),
            'date_fin' => now(),
        ]);
        $res->assertStatus(302);
        $res->assertSessionHas('success', 'Document ajouté');
        $res->assertSessionHas('subtitle', 'Votre document a été ajouté avec succès à la liste.');
        $res->assertRedirect(route('paiperPersonnel.index'));
    }
}
