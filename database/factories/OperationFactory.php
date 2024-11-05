<?php

namespace Database\Factories;

use App\Models\Operation;
use App\Models\Voiture;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperationFactory extends Factory
{
    protected $model = Operation::class;

    public function definition()
    {
        return [
            'categorie' => $this->faker->word,
            'nom' => $this->faker->word,
            'description' => $this->faker->sentence(),
            'date_operation' => $this->faker->date(),
            'voiture_id' => Voiture::factory(), // Assuming Voiture factory exists
        ];
    }
}