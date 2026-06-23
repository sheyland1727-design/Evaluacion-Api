<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Cargo;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CargoTest extends TestCase
{
    use RefreshDatabase;

    private function autenticar()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);
    }

    public function test_listar_cargos(): void
    {
        $this->autenticar();

        Cargo::factory()->count(3)->create();

        $response = $this->getJson('/api/cargos');

        $response->assertStatus(200);
    }

    public function test_crear_cargo(): void
    {
        $this->autenticar();

        $response = $this->postJson('/api/cargos', [
            'nombre_cargo' => 'Desarrollador',
            'descripcion' => 'Desarrolla aplicaciones'
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('cargos', [
            'nombre_cargo' => 'Desarrollador'
        ]);
    }

    public function test_mostrar_cargo(): void
    {
        $this->autenticar();

        $cargo = Cargo::factory()->create();

        $response = $this->getJson('/api/cargos/' . $cargo->id);

        $response->assertStatus(200);
    }

    public function test_cargo_no_existe(): void
    {
        $this->autenticar();

        $response = $this->getJson('/api/cargos/9999');

        $response->assertStatus(404);

        $response->assertJson([
            'message' => 'Cargo no existe'
        ]);
    }

    public function test_actualizar_cargo(): void
    {
        $this->autenticar();

        $cargo = Cargo::factory()->create();

        $response = $this->putJson('/api/cargos/' . $cargo->id, [
            'nombre_cargo' => 'Analista',
            'descripcion' => 'Analiza procesos'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('cargos', [
            'id' => $cargo->id,
            'nombre_cargo' => 'Analista'
        ]);
    }

    public function test_eliminar_cargo(): void
    {
        $this->autenticar();

        $cargo = Cargo::factory()->create();

        $response = $this->deleteJson('/api/cargos/' . $cargo->id);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('cargos', [
            'id' => $cargo->id
        ]);
    }
}