<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cargo;
use App\Models\Empleado;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cargos = Cargo::pluck('id')->toArray();

        for ($i = 0; $i < 30; $i++) {

            Empleado::factory()->create([
                'cargo_id' => $cargos[array_rand($cargos)]
            ]);

        }
    }
}