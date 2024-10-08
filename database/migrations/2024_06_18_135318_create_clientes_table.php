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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('documento');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('email');
            $table->string('telefono');
            $table->foreignId('departamentos_id')->constrained('departamentos')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('ciudades_id')->constrained('ciudades')->restrictOnUpdate()->restrictOnDelete();
            $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
