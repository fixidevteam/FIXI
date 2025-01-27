<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminGestionUserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_admin_must_be_authenticated_to_access_user_management()
    {
        $response = $this->get(route('admin.gestionUtilisateurs.index'));
        $response->assertRedirect('fp-admin/login'); // Assuming '/login' is the admin login route
        // index 
        $admin = Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        User::create(['name' => 'User 1', 'email' => 'user1@example.com', 'password' => bcrypt('password'), 'ville' => 'fes', 'status' => true]);
        User::create(['name' => 'User 2', 'email' => 'user2@example.com', 'password' => bcrypt('password'), 'ville' => 'fes', 'status' => false]);

        $response = $this->actingAs($admin, 'admin')->get('fp-admin/gestionUtilisateurs');

        $response->assertStatus(200);
        $response->assertViewHas('users', function ($users) {
            return $users->count() === 2;
        });

        
        $user = User::create([
            'name' => 'User 11',
            'email' => 'use11r1@example.com',
            'password' => bcrypt('password'),
            'status' => true,
            'ville'=>'fes'
        ]);

        $response = $this->actingAs($admin, 'admin')->post('fp-admin/users/'.$user->id.'/toggle-status');

        $response->assertRedirect(route('admin.gestionUtilisateurs.index'));
        $response->assertSessionHas('success', 'Statut de l\'utilisateur mis à jour avec succès.');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'status' => false,
        ]);


        $user = User::create([
            'name' => 'Use111r 1',
            'email' => 'us11111er1@example.com',
            'password' => bcrypt('password'),
            'status' => true,
            'ville'=>'fes'
        ]);

        $response = $this->actingAs($admin, 'admin')->get('fp-admin/gestionUtilisateurs/show',['id'=> $user->id]);

        $response->assertStatus(200);
        $response->assertViewHas('user', $user);
    }




}
