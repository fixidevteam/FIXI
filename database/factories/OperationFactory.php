<?php

namespace Database\Factories;

use App\Models\garage;
use App\Models\Operation;
use App\Models\Voiture;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperationFactory extends Factory
{
    protected $model = Operation::class;

    public function definition()
    {
        return [
            'categorie' => 1,
            'nom' => 1,
            'description' => $this->faker->sentence,
            'date_operation' => $this->faker->date,
            'voiture_id' => 6,
            'garage_id' => $this->faker->randomElement(garage::all())->id
        ];
    }
}
