<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voiture;

class VoitureSeeder extends Seeder
{
    public function run()
    {
        // Create 10 random Voiture entries
        Voiture::factory()->count(10)->create();
    }
}