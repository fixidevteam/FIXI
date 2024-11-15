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
            'Carte Grise',
            'Visite Technique',
            'Assurance Auto',
            'Certificat de Dédouanement',
            'Permis de Circulation Temporaire',
            'Procès-verbal d\'Accord de Transformation',
            'Vignette',
            'Reçu de Vente',
            'Attestation d\'Immatriculation Provisoire',
            'Fiche Technique ',
        ]; // Replace with your types

        foreach ($types as $type) {
            type_papierv::create(['type' => $type]);
        }
    }
}