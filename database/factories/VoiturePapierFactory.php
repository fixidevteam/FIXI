<?php

namespace Database\Factories;

use App\Models\Voiture;
use App\Models\VoiturePapier;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoiturePapierFactory extends Factory
{
    protected $model = VoiturePapier::class;

    public function definition()
    {
        return [
            'type' => $this->faker->word,
            'photo' => $this->faker->imageUrl(),
            'note' => $this->faker->sentence(),
            'date_debut' => $this->faker->date(),
            'date_fin' => $this->faker->date(),
            'voiture_id' => $this->faker->randomElement(Voiture::class::all())->id,
        ];
    }
}