<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_fixi_pro_logo(): void
    {
        $response = $this->get('fixi-pro/login');

        $response->assertStatus(200);
        $response->assertViewIs('mechanic.auth.login');
        $response->assertSee('/images/fixi-pro.svg');
    }
    public function test_fixi_plus_logo(): void
    {
        $response = $this->get('fixi-plus/login');

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
        $response->assertSee('/images/fixi-plus.svg');
    }
}
