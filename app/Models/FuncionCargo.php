<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuncionCargo extends Model
{
    /** @use HasFactory<\Database\Factories\FuncionCargoFactory> */
    use HasFactory;

     protected $fillable = [
        'cargo_id',
        'descripcion_funcion',
        'estado'
    ];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
}
