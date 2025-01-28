<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\UserPapier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserPapierTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_has_correct_fillable_attributes()
    {
        $userPapier = new UserPapier();
        $this->assertEquals(
            ['type', 'photo', 'note', 'date_debut', 'date_fin', 'user_id'],
            $userPapier->getFillable()
        );
    }

    /** @test */
    public function test_it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $papier = UserPapier::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($papier->user->is($user));
    }
}
