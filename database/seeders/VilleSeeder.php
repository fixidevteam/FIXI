<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $villes = [
            ['ville' => 'Casablanca'],
            ['ville' => 'Rabat'],
            ['ville' => 'Fès'],
            ['ville' => 'Marrakech'],
            ['ville' => 'Tanger'],
            ['ville' => 'Agadir'],
            ['ville' => 'Meknès'],
            ['ville' => 'Oujda'],
            ['ville' => 'Tetouan'],
            ['ville' => 'Safi'],
        ];

        DB::table('villes')->insert($villes);
    }
}