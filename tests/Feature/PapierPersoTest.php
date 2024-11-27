<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PapierPersoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function AjouterPapierPerso(): void
    {
        $user = User::factory()->create(['status'=>1]);
        $res = $this->actingAs($user)->post('paiperPersonnel');
        $res->assertOk();

    }
}
