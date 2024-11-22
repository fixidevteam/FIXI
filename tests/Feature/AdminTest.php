<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use App\Models\Mechanic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    // Test if an admin user can access admin functionalities
    public function test_admin_can_access_admin_functionalities()
    {
        $admin = new Admin();
        $admin->name = 'Admin User';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('admin123');
        $admin->save();

        $this->actingAs($admin, 'admin'); // Use 'admin' guard

        $response = $this->get('/admin/dashboard');

        $response->assertStatus(200); // Assuming 200 is the status code for success
    }
    // Test if an user can access admin functionalities
    public function test_user_can_access_admin_functionalities()
    {
        $user = new User();
        $user->name = 'User User';
        $user->email = 'user@gmail.com';
        $user->password = bcrypt('user123');
        $user->save();

        $this->actingAs($user, 'admin'); // Use 'admin' guard

        $response = $this->get('/admin/dashboard');

        $response->assertStatus(200); // Assuming 200 is the status code for success
    }
    // Test if an mechanic user can access admin functionalities
    public function test_mechanic_can_access_admin_functionalities()
    {
        $mechanic = new Mechanic();
        $mechanic->name = 'Mechanic User';
        $mechanic->email = 'mechanic@gmail.com';
        $mechanic->password = bcrypt('mechanic123');
        $mechanic->save();

        $this->actingAs($mechanic, 'admin'); // Use 'admin' guard

        $response = $this->get('/admin/dashboard');

        $response->assertStatus(200); // Assuming 200 is the status code for success
    }
}