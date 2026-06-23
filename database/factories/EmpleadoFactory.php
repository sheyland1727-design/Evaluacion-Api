<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    protected $model = Empleado::class;

    public function definition(): array
    {
        return [
            'cargo_id' => 1,
            'nombres' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'fecha_nacimiento' => $this->faker->date(),
            'fecha_ingreso' => $this->faker->date(),
            'salario' => $this->faker->numberBetween(1300000, 5000000),
            'estado' => true,
        ];
    }
}
