<?php

namespace Database\Factories;

use App\Models\Cargo;
use Illuminate\Database\Eloquent\Factories\Factory;

class CargoFactory extends Factory
{
    protected $model = Cargo::class;

    public function definition(): array
    {
        return [
            'nombre_cargo' => $this->faker->jobTitle(),
            'descripcion' => $this->faker->sentence(),
        ];
    }
}