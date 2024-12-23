<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\garage;
use App\Models\Mechanic;
use App\Models\nom_categorie;
use App\Models\nom_operation;
use App\Models\nom_sous_operation;
use App\Models\type_papierp;
use App\Models\type_papierv;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Creating categories (nom_categorie)
        $category1 = nom_categorie::create(['nom_categorie' => "Services d'un garage mécanique"]);
        $category2 = nom_categorie::create(['nom_categorie' => "Services d'un garage de lavage"]);
        $category3 = nom_categorie::create(['nom_categorie' => "Services d'un garage de carrosserie"]);
        $category4 = nom_categorie::create(['nom_categorie' => "Services d'un garage pneumatique"]);


        // // Creating operations (nom_operation) and linking to categories
        nom_operation::create([
            'nom_operation' => 'Réparation de moteur',
            'nom_categorie_id' => $category1->id  // Link to "Services d'un Garage Mécanique"
        ]);

        nom_operation::create([
            'nom_operation' => 'Entretien et vidange',
            'nom_categorie_id' => $category1->id  // Link to "Services d'un Garage Mécanique"
        ]);

        nom_operation::create([
            'nom_operation' => 'Diagnostic électronique',
            'nom_categorie_id' => $category1->id  // Link to "Services d'un Garage Mécanique"
        ]);

        nom_operation::create([
            'nom_operation' => 'Lavage extérieur',
            'nom_categorie_id' => $category2->id  // Link to "Services d'un Garage de Lavage"
        ]);

        nom_operation::create([
            'nom_operation' => 'Lavage intérieur',
            'nom_categorie_id' => $category2->id  // Link to "Services d'un Garage de Lavage"
        ]);

        nom_operation::create([
            'nom_operation' => 'Nettoyage des sièges et tapis',
            'nom_categorie_id' => $category2->id  // Link to "Services d'un Garage de Lavage"
        ]);

        nom_operation::create([
            'nom_operation' => 'Réparation de carrosserie',
            'nom_categorie_id' => $category3->id  // Link to "Services d'un Garage de Carrosserie"
        ]);

        nom_operation::create([
            'nom_operation' => 'Peinture de carrosserie',
            'nom_categorie_id' => $category3->id  // Link to "Services d'un Garage de Carrosserie"
        ]);

        nom_operation::create([
            'nom_operation' => 'Redressage de châssis',
            'nom_categorie_id' => $category3->id  // Link to "Services d'un Garage de Carrosserie"
        ]);

        nom_operation::create([
            'nom_operation' => 'Vente de pneus',
            'nom_categorie_id' => $category4->id  // Link to "Services d'un Garage Pneumatique"
        ]);

        nom_operation::create([
            'nom_operation' => 'Montage de pneus',
            'nom_categorie_id' => $category4->id  // Link to "Services d'un Garage Pneumatique"
        ]);

        nom_operation::create([
            'nom_operation' => 'Équilibrage des pneus',
            'nom_categorie_id' => $category4->id  // Link to "Services d'un Garage Pneumatique"
        ]);


        nom_sous_operation::create([
            'nom_sous_operation' => 'Remplacement des filtres à air',
            'nom_operation_id' => '2'
        ]);
        nom_sous_operation::create([
            'nom_sous_operation' => 'Remplacement des filtres à huile',
            'nom_operation_id' => '2'
        ]);
        nom_sous_operation::create([
            'nom_sous_operation' => 'Remplacement des filtres à carburant',
            'nom_operation_id' => '2'
        ]);

        garage::create([
            'id' => 1,
            'name' => 'Auto Atlas',
            'ref' => 'GAR-00001',
            'localisation' => 'marrakech, cherifia',
            'ville' => 'Marrakech',
        ]);
        garage::create([
            'id' => 2,
            'name' => 'Auto Madina',
            'ref' => 'GAR-00002',
            'localisation' => 'marrakech, Madina',
            'ville' => 'Marrakech',

        ]);
        garage::create([
            'id' => 3,
            'name' => 'Auto Nassim',
            'ref' => 'GAR-00003',
            'localisation' => 'marrakech, Nassim',
            'ville' => 'Marrakech',

        ]);
        garage::create([
            'id' => 4,
            'name' => 'Auto Tari9',
            'ref' => 'GAR-00004',
            'localisation' => 'marrakech, Mhamid',
            'ville' => 'Marrakech',
        ]);

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
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminadmin')
        ]);
        // Mechanic::create([
        //     'name' => 'mechannic',
        //     'email' => 'user@gmail.com',
        //     'password' => Hash::make('user12345'),
        //     'garage_id'=>1 
        // ]);
        // $this->call([
        //     OperationSeeder::class,

        // Other seeders can be listed here
        // ]);
        // Mechanic::create([
        //     'name' => 'mechannic',
        //     'email' => 'user1@gmail.com',
        //     'password' => Hash::make('user12345'),
        //     'garage_id'=>1 
        // ]);
    }
}