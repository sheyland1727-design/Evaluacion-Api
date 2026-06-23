<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cargo;

class CargoSeeder extends Seeder
{
    public function run(): void
    {
        Cargo::factory()->count(40)->create();
    }
}