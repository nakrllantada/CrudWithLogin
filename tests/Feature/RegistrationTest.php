<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    public function testUserCanRegister()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }

    public function testUserRegistrationFailsWithInvalidData()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'invalid-email', // Invalid email format
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);


        $response->assertStatus(400);
    }
}
