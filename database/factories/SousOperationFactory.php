<?php

namespace Database\Factories;

use App\Models\SousOperation;
use App\Models\Operation;
use Illuminate\Database\Eloquent\Factories\Factory;

class SousOperationFactory extends Factory
{
    protected $model = SousOperation::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'description' => $this->faker->sentence(),
            'operation_id' => Operation::factory(), // Assuming Operation factory exists
        ];
    }
}