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
        $admin = new Admin(['garage_id'=>1]);
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
        $admin = new Admin();
        $admin->name = 'admin$admin admin$admin';
        $admin->email = 'adminadmin@gmail.com';
        $admin->password = bcrypt('admin$admin123');
        $admin->save();

        $this->actingAs($admin, 'admin'); // Use 'admin' guard

        $response = $this->get('/admin/dashboard');

        $response->assertStatus(200); // Assuming 200 is the status code for success
    }
    // Test if an mechanic admin$admin can access admin functionalities
    public function test_mechanic_can_access_admin_functionalities()
    {
        $mechanic = new Mechanic(['garage_id'=>1]);
        $mechanic->name = 'Mechanic User';
        $mechanic->email = 'mechanic@gmail.com';
        $mechanic->password = bcrypt('mechanic123');
        $mechanic->save();

        $this->actingAs($mechanic, 'admin'); // Use 'admin' guard

        $response = $this->get('/admin/dashboard');

        $response->assertStatus(200); // Assuming 200 is the status code for success
    }
}