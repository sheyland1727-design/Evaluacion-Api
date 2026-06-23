<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::firstOrCreate(
    ['email' => 'admin@correo.com'],
    [
        'name' => 'Administrador',
        'password' => Hash::make('12345678'),
    ]
);
        $this->call([
            CargoSeeder::class,
            FuncionCargoSeeder::class,
            EmpleadoSeeder::class,
        ]);
    }
}
