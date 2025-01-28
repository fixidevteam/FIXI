<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\UserPapier;
use App\Models\Voiture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_has_correct_fillable_attributes()
    {
        $user = new User();
        $this->assertEquals(
            ['name', 'email', 'password', 'ville', 'quartier', 'provider', 'provider_id', 'provider_token', 'telephone', 'status', 'created_by_mechanic', 'mechanic_id'],
            $user->getFillable()
        );
    }

    /** @test */
    public function test_it_hides_correct_attributes()
    {
        $user = User::factory()->create();
        $hiddenAttributes = $user->getHidden();
        $this->assertContains('password', $hiddenAttributes);
        $this->assertContains('remember_token', $hiddenAttributes);
    }

    /** @test */
    public function test_it_has_many_papiers_users()
    {
        $user = User::factory()->create();
        UserPapier::factory()->count(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->papiersUsers);
    }

    /** @test */
    public function test_it_has_many_voitures()
    {
        $user = User::factory()->create();
        Voiture::factory()->count(2)->create(['user_id' => $user->id]);

        $this->assertCount(2, $user->voitures);
    }

    /** @test */
    public function test_it_checks_if_user_is_active()
    {
        $user = User::factory()->create(['status' => true]);
        $this->assertTrue($user->isActive());

        $user->update(['status' => false]);
        $this->assertFalse($user->isActive());
    }
}
