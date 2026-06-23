<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Cargo;
use App\Models\FuncionCargo;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FuncionCargoTest extends TestCase
{
    use RefreshDatabase;

    private function autenticar()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);
    }

    public function test_listar_funciones(): void
    {
        $this->autenticar();

        $cargo = Cargo::factory()->create();

        FuncionCargo::factory()->count(3)->create([
            'cargo_id' => $cargo->id
        ]);

        $response = $this->getJson('/api/funciones');

        $response->assertStatus(200);
    }

    public function test_crear_funcion(): void
    {
        $this->autenticar();

        $cargo = Cargo::factory()->create();

        $response = $this->postJson('/api/funciones', [
            'cargo_id' => $cargo->id,
            'descripcion_funcion' => 'Programar aplicaciones',
            'estado' => true
        ]);

        $response->assertStatus(201);
    }

    public function test_funcion_no_existe(): void
    {
        $this->autenticar();

        $response = $this->getJson('/api/funciones/9999');

        $response->assertStatus(404);

        $response->assertJson([
            'message' => 'Función no existe'
        ]);
    }

    public function test_actualizar_funcion(): void
    {
        $this->autenticar();

        $cargo = Cargo::factory()->create();

        $funcion = FuncionCargo::factory()->create([
            'cargo_id' => $cargo->id
        ]);

        $response = $this->putJson('/api/funciones/' . $funcion->id, [
            'cargo_id' => $cargo->id,
            'descripcion_funcion' => 'Analizar requerimientos',
            'estado' => true
        ]);

        $response->assertStatus(200);
    }

    public function test_eliminar_funcion(): void
    {
        $this->autenticar();

        $cargo = Cargo::factory()->create();

        $funcion = FuncionCargo::factory()->create([
            'cargo_id' => $cargo->id
        ]);

        $response = $this->deleteJson('/api/funciones/' . $funcion->id);

        $response->assertStatus(200);
    }
}
