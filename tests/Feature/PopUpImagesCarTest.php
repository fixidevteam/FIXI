<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PopUpImagesCarTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_popup_image_car(): void
    {
        $user = User::factory()->create(['status' => 1]);
        $response = $this->actingAs($user)->get(route('voiture.index'));
        $response->assertStatus(200)
            ->assertViewIs('userCars.index');
        $response->assertSee('img.object-cover');
        $response->assertSee('imageModal')->assertSee('hidden') ;
        
    }
}
