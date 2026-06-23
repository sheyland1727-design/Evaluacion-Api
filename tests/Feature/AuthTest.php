<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_correcto(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@correo.com',
            'password' => bcrypt('12345678')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'admin@correo.com',
            'password' => '12345678'
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'message',
            'token'
        ]);
    }

    public function test_login_incorrecto(): void
    {
        User::factory()->create([
            'email' => 'admin@correo.com',
            'password' => bcrypt('12345678')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'admin@correo.com',
            'password' => 'incorrecta'
        ]);

        $response->assertStatus(401);

        $response->assertJson([
            'message' => 'Credenciales incorrectas.'
        ]);
    }

    public function test_logout(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $token = $user->createToken('auth_token');

        $response = $this->withHeader(
            'Authorization',
            'Bearer '.$token->plainTextToken
        )->postJson('/api/logout');

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'Sesión cerrada correctamente.'
        ]);
    }
}
