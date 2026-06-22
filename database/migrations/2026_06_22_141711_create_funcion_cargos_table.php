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

    Schema::create('funcion_cargos', function (Blueprint $table) {
        $table->id();

        $table->foreignId('cargo_id')
            ->constrained('cargos')
            ->cascadeOnDelete();

        $table->text('descripcion_funcion');
        $table->boolean('estado')->default(true);

        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcion_cargos');
    }
};
