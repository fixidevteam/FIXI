<?php

namespace Database\Seeders;

use App\Models\type_papierv;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypePapiervSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Carte grise',
            'Visite technique',
            'Assurance auto',
            'Certificat de dédouanement',
            'Permis de circulation temporaire',
            'Procès-verbal d\'accord de transformation',
            'Vignette',
            'Reçu de vente',
            'Attestation d\'immatriculation provisoire',
            'Fiche technique',
        ]; // Replace with your types

        foreach ($types as $type) {
            type_papierv::create(['type' => $type]);
        }
    }
}