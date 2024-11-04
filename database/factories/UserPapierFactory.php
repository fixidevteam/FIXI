<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserPapier;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserPapierFactory extends Factory
{
    protected $model = UserPapier::class;

    public function definition()
    {
        return [
            'type' => $this->faker->word,
            'photo' => $this->faker->imageUrl(),
            'note' => $this->faker->sentence(),
            'date_debut' => $this->faker->date(),
            'date_fin' => $this->faker->date(),
            'user_id' => User::factory(), // Assuming User factory exists
        ];
    }
}