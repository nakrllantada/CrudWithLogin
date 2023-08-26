<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a user with a valid JWT token.
     *
     * @return void
     */
    public function testCreateUserWithValidJwtToken()
    {
        $user = User::factory()->create();

        // Generate a valid JWT token for the user
        $token = JWTAuth::fromUser($user);

        $response = $this->postJson('/api/auth/user', [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password123',
        ], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertOk();
    }
}
