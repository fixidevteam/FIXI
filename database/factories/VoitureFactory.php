<?php

namespace Database\Factories;

use App\Models\Voiture;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoitureFactory extends Factory
{
    protected $model = Voiture::class;

    public function definition()
    {
        return [
            'numero_immatriculation' => $this->faker->unique()->bothify('####-?-##'),
            'marque' => $this->faker->word,
            'modele' => $this->faker->word,
            'photo' => $this->faker->imageUrl(),
            'date_de_première_mise_en_circulation' => $this->faker->date(),
            'date_achat' => $this->faker->date(),
            'date_de_dédouanement' => $this->faker->date(),
            'user_id' => \App\Models\User::factory(), // Assuming a User factory exists
        ];
    }
}