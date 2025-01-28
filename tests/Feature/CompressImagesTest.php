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

use function PHPUnit\Framework\assertLessThan;

class CompressImagesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_compress_images(): void
    {
        // Fake the storage for testing
        Storage::fake('public');
        $user = User::factory()->create(['status' => 1, 'ville' => 'marrakech']);
        $photo = HttpUploadedFile::fake()->image('fixiRepair.jpg')->size(3072); // 5000 KB (5 MB)
        $type = type_papierp::create(['type' => 'Pass']);
        // Assert the size before upload
        $this->assertEquals(3145728, $photo->getSize());

        $res = $this->actingAs($user)->post('fixi-plus/paiperPersonnel', [
            'type' => 'Pass',
            'note' => 'notes',
            'photo' => $photo,
            'date_debut' => now(),
            'date_fin' => now(),
        ]);
        // Assert the response status is a 302 redirect
        $res->assertStatus(302);
        $storedFilePath = $user->papiersUsers()->first()->photo; // Ensure this is relative to 'public'

        // Get the full path to the file
        $fullFilePath = storage_path('app/public/' . $storedFilePath);

        // Check if the file exists and get its size
        if (file_exists($fullFilePath)) {
            $fileSize = filesize($fullFilePath); // File size in bytes

            // Assert that the file size is less than 1 MB (1048576 bytes)
            $this->assertLessThan(3145728, $fileSize, 'The file size should be less than 1 MB.');
        } else {
            dd('File does not exist: ' . $fullFilePath);
        }

        $this->assertDatabaseHas('user_papiers', [
            'user_id' => $user->id,
            'type' => 'Pass',
        ]);
    }
}
