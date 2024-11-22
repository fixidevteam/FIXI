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
            'Carte nationale d\'identité (cin)',
            'Passeport',
            'Permis de conduire',
            'Certificat de résidence',
            'Carte bancaire',
            'Certificat médical',
            'Diplômes académiques',
            'Certificat de travail',
            'Carte de séjour',
            'Certificat de mariage',
            'Certificat de décès',
            'Acte de naissance',
            'Livret de famille',
        ]; // Replace with your types

        foreach ($types as $type) {
            type_papierp::create(['type' => $type]);
        }
    }
}