<?php

namespace Database\Factories;

use App\Models\FuncionCargo;
use Illuminate\Database\Eloquent\Factories\Factory;

class FuncionCargoFactory extends Factory
{
    protected $model = FuncionCargo::class;

    public function definition(): array
    {
        return [
            'cargo_id' => 1,
            'descripcion_funcion' => $this->faker->sentence(),
            'estado' => true,
        ];
    }
}
