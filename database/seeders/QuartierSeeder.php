<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuartierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quartiers = [
            ['quartier' => 'Maarif', 'ville_id' => 1], // Casablanca
            ['quartier' => 'Ain Diab', 'ville_id' => 1], // Casablanca
            ['quartier' => 'Agdal', 'ville_id' => 2], // Rabat
            ['quartier' => 'Hay Riad', 'ville_id' => 2], // Rabat
            ['quartier' => 'Zitoune', 'ville_id' => 3], // Fès
            ['quartier' => 'Sidi Boujida', 'ville_id' => 3], // Fès
            ['quartier' => 'Gueliz', 'ville_id' => 4], // Marrakech
            ['quartier' => 'Hivernage', 'ville_id' => 4], // Marrakech
            ['quartier' => 'Marchan', 'ville_id' => 5], // Tanger
            ['quartier' => 'Drissia', 'ville_id' => 5], // Tanger
        ];

        DB::table('quartiers')->insert($quartiers);
    }
}