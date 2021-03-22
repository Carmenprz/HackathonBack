<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class SanctumTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        $data = [
            'name' => 'Giacomo',
            'email' => 'root@root.com',
            'password' => Hash::make('password'),
        ];

        $response = $this->postJson('/api/register', $data);

        $this->assertDatabaseCount('users', 1)
            ->assertDatabaseHas('users', ['name' => 'Giacomo', 'email' => 'root@root.com']);

        $response->assertJson(['token_type' => 'Bearer'])
            ->assertStatus(201);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password')
        ]);

        $response = $this->postJson('api/login', ['email' => $user->email, 'password' => $user->password]);

        $response->assertStatus(200);
    }

    public function test_user_can_logout()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->getJson('/api/logout');

        $response->assertStatus(200)
            ->assertJson(['message' => 'User disconnected']);
    }
}
