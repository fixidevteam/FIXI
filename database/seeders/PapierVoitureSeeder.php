<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VoiturePapier;

class PapierVoitureSeeder extends Seeder
{
    public function run()
    {
        // Create 10 random PapierVoiture entries
        VoiturePapier::factory()->count(10)->create();
    }
}