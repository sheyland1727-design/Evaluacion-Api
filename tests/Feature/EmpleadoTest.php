<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Cargo;
use App\Models\Empleado;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmpleadoTest extends TestCase
{
    use RefreshDatabase;

    private function autenticar()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);
    }

    public function test_listar_empleados(): void
    {
        $this->autenticar();

        $cargo = Cargo::factory()->create();

        Empleado::factory()->count(3)->create([
            'cargo_id' => $cargo->id
        ]);

        $response = $this->getJson('/api/empleados');

        $response->assertStatus(200);
    }

    public function test_crear_empleado(): void
    {
        $this->autenticar();

        $cargo = Cargo::factory()->create();

        $response = $this->postJson('/api/empleados', [
            'cargo_id' => $cargo->id,
            'nombres' => 'Juan',
            'apellidos' => 'Perez',
            'fecha_nacimiento' => '2000-01-01',
            'fecha_ingreso' => '2024-01-01',
            'salario' => 2500000,
            'estado' => true
        ]);

        $response->assertStatus(201);
    }

    public function test_empleado_no_existe(): void
    {
        $this->autenticar();

        $response = $this->getJson('/api/empleados/9999');

        $response->assertStatus(404);

        $response->assertJson([
            'message' => 'Empleado no existe'
        ]);
    }

    public function test_actualizar_empleado(): void
    {
        $this->autenticar();

        $cargo = Cargo::factory()->create();

        $empleado = Empleado::factory()->create([
            'cargo_id' => $cargo->id
        ]);

        $response = $this->putJson('/api/empleados/'.$empleado->id, [
            'cargo_id' => $cargo->id,
            'nombres' => 'Carlos',
            'apellidos' => 'Lopez',
            'fecha_nacimiento' => '1999-01-01',
            'fecha_ingreso' => '2023-01-01',
            'salario' => 3000000,
            'estado' => true
        ]);

        $response->assertStatus(200);
    }

    public function test_eliminar_empleado(): void
    {
        $this->autenticar();

        $cargo = Cargo::factory()->create();

        $empleado = Empleado::factory()->create([
            'cargo_id' => $cargo->id
        ]);

        $response = $this->deleteJson('/api/empleados/'.$empleado->id);

        $response->assertStatus(200);
    }
}

