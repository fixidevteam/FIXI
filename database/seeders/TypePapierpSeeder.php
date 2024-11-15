<?php

namespace Database\Seeders;

use App\Models\type_papierp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypePapierpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Carte Nationale d\'Identité (CIN)',
            'Passeport',
            'Permis de Conduire',
            'Certificat de Résidence',
            'Carte Bancaire',
            'Certificat Médical',
            'Diplômes Académiques',
            'Certificat de Travail',
            'Carte de Séjour',
            'Certificat de Mariage',
            'Certificat de Décès',
            'Acte de Naissance',
            'Livret de Famille',
        ]; // Replace with your types

        foreach ($types as $type) {
            type_papierp::create(['type' => $type]);
        }
    }
}