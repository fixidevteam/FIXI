<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SousOperation;

class SousOperationSeeder extends Seeder
{
    public function run()
    {
        // Create 10 random SousOperation entries
        SousOperation::factory()->count(10)->create();
    }
}