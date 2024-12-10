<?php

namespace Database\Seeders;

use App\Models\MarqueVoiture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MarqueVoiture::create(['marque' => 'Dacia']);
        MarqueVoiture::create(['marque' => 'Renault']);
        MarqueVoiture::create(['marque' => 'Peugeot']);
        MarqueVoiture::create(['marque' => 'Citroën']);
        MarqueVoiture::create(['marque' => 'Volkswagen']);
        MarqueVoiture::create(['marque' => 'Toyota']);
        MarqueVoiture::create(['marque' => 'Hyundai']);
        MarqueVoiture::create(['marque' => 'Fiat']);
        MarqueVoiture::create(['marque' => 'Mercedes-Benz']);
        MarqueVoiture::create(['marque' => 'BMW']);
        MarqueVoiture::create(['marque' => 'Kia']);
        MarqueVoiture::create(['marque' => 'Ford']);
    }
}