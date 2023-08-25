<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationApiTest extends TestCase
{
    use  WithFaker;

    public function testUserCanRegister()
    {
        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'Strong@0917',
            'password_confirmation' => 'Strong@0917',
        ];

        $response = $this->json('POST', '/api/register', $userData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
        ]);
    }

    public function testInvalidRegistration()
    {
        $response = $this->json('POST', '/api/register', []);

        $this->assertGuest();
    }
}
