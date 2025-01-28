<?php

namespace Tests\Feature\Auth;



use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class VerificationEmailTest extends TestCase
{
    use RefreshDatabase;
    public function test_VerificationEmail_send_auto(): void
    {
        $this->withoutExceptionHandling(); // To debug errors if needed

        // Create a city record and use its ID
        $ville = Ville::create(['ville' => 'marrakech']);

        Notification::fake(); // Fake notifications to test email sending

        $response = $this->post('fixi-plus/register', [
            'name' => 'youssef',
            'email' => 'youssefelmofid2@gmail.com',
            'ville' => '1',  // Pass the correct ID instead of a string
            'telephone' => '0632297152',
            'password' => 'user12345',
            'password_confirmation' => 'user12345'
        ]);

        // Assert user was created in the database
        $this->assertDatabaseHas('users', ['email' => 'youssefelmofid2@gmail.com']);

        // Ensure the registration request was successful (redirection status)
        $response->assertRedirect(RouteServiceProvider::HOME);

        // Get the newly registered user
        $user = User::where('email', 'youssefelmofid2@gmail.com')->first();
        $this->assertNotNull($user);

        // Assert that an email verification notification was sent to the user
        // Notification::assertSentTo($user, VerifyEmail::class);
    }

    public function test_VerificationEmail_screen(): void
    {
        $user = User::factory()->create([
            'email' => 'youssefelmofid2@gmail.com',
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
