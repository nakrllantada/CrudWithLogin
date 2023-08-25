<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginApiTest extends TestCase
{
    use  WithFaker, RefreshDatabase;

    public function testUserCanLogin()
    {

        $user = User::create([
            'name' => 'test',
            'email' => 'nak.llantada@gmail.com',
            'password' => Hash::make('qweqweqwe'),
            'email_verified_at' => "2023-08-25 11:58:06"
        ]);


        $response = $this->json('POST', '/api/login', [
            'email' => 'nak.llantada@gmail.com',
            'password' => 'qweqweqwe'
        ]);

        $response->assertOk();

        $this->assertAuthenticatedAs($user);
    }
}
