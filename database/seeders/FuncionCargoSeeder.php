<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cargo;
use App\Models\FuncionCargo;

class FuncionCargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cargos = Cargo::all();

        foreach ($cargos as $cargo) {

            FuncionCargo::factory()
                ->count(5)
                ->create([
                    'cargo_id' => $cargo->id
                ]);

        }
    }
}