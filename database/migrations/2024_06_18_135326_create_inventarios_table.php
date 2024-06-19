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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre');
            $table->integer('existencias');
            $table->float('valor');
            $table->float('total');
            $table->integer('minimo');
            $table->foreignId('categorias_id')->constrained('categorias')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('marcas_id')->constrained('marcas')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('bodegas_id')->constrained('bodegas')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('proveedores_id')->constrained('proveedores')->restrictOnUpdate()->restrictOnDelete();
            $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
