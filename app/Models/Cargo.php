<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    /** @use HasFactory<\Database\Factories\CargoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre_cargo',
        'descripcion'
    ];
    
    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }

    public function funcionesCargo()
    {
        return $this->hasMany(FuncionCargo::class);
    }
}

