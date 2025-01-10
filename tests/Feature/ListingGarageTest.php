<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListingGarageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_search_filters_garages_correctly()
    {
        // Create test data for users, villes, and garages
        $user = \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'usertest07gmail.com',
            'password' => bcrypt('password'),
            'ville' => 'Marrakech', // Default city for the user
            'status' => 1,
        ]);

        $ville1 = \App\Models\Ville::create(['ville' => 'Marrakech']);
        $ville2 = \App\Models\Ville::create(['ville' => 'VilleB']);

        // Create garages with specific villes and user_id
        $garage1 = \App\Models\Garage::create([
            'name' => 'Garage1',
            'ville' => 'Marrakech',
            'ref' => 'GAR-12345',
            'user_id' => null, // Should be included
        ]);
        $garage2 = \App\Models\Garage::create([
            'name' => 'Garage2',
            'ville' => 'Marrakech',
            'ref' => 'GAR-12982',
            'user_id' => 1, // Should be excluded
        ]);
        $garage3 = \App\Models\Garage::create([
            'name' => 'Garage3',
            'ville' => 'VilleB',
            'ref' => 'GAR-12932',
            'user_id' => null, // Should be excluded
        ]);

        // Simulate authenticated user
        $this->actingAs($user);

        // Make a GET request with the search parameter 'ville'
        $response = $this->get(route('garages.index', ['ville' => 'Marrakech']));

        // Assert the response is successful
        $response->assertStatus(200);

        // Assert 'garages' contains only the correct filtered garage
        $response->assertViewHas('garages', function ($garages) use ($garage1) {
            return $garages->total() === 1 && $garages->first()->id === $garage1->id;
        });

        // Assert 'searchVille' is passed correctly to the view
        $response->assertViewHas('searchVille', 'Marrakech');
    }
}