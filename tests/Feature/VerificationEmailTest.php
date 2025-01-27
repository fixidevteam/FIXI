<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class VerificationEmailTest extends TestCase
{
    use RefreshDatabase;
    public function test_VerificationEmail_send_auto(): void
    {
        $user = User::factory()->create([
            'email'=>'youssefelmofid2@gmail.com',
            'ville' => 'marrakech',
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->get('/fixi-plus/verify-email');

        $response->assertStatus(200);
    }



    public function test_VerificationEmail_screen(): void
    {
        $user = User::factory()->create([
            'email'=>'youssefelmofid2@gmail.com',
            'ville' => 'marrakech',
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->get('/fixi-plus/verify-email');

        $response->assertStatus(200);
    }

    public function test_VerificationEmail_can_be_verified(): void
    {
        $user = User::factory()->create([
            'ville' => 'marrakech',
            'email_verified_at' => null,
        ]);

        Event::fake();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        Event::assertDispatched(Verified::class);
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        $response->assertRedirect(RouteServiceProvider::HOME . '?verified=1');
    }

    public function test_is_not_verified_with_invalid_hash(): void
    {
        $user = User::factory()->create([
            'ville' => 'marrakech',
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1('wrong-email')]
        );

        $this->actingAs($user)->get($verificationUrl);

        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }
}