<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserPapier;

class PapierUserSeeder extends Seeder
{
    public function run()
    {
        // Create 10 random PapierUser entries
        UserPapier::factory()->count(10)->create();
    }
}