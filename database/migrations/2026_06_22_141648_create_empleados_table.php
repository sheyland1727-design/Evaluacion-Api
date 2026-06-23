<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
    Schema::create('empleados', function (Blueprint $table) {
        $table->id();

        $table->foreignId('cargo_id')
            ->constrained('cargos')
            ->cascadeOnDelete();

        $table->string('nombres');
        $table->string('apellidos');
        $table->date('fecha_nacimiento');
        $table->date('fecha_ingreso');
        $table->decimal('salario', 12, 2);
        $table->boolean('estado')->default(true);

        $table->timestamps();
    });
}
        
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
