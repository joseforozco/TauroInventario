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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha', precision: 0);
            $table->foreignId('clientes_id')->constrained('clientes')->restrictOnUpdate()->restrictOnDelete();
            $table->string('numerofactura');
            $table->float('valorfactura');
            $table->float('ivafactura');
            $table->float('totalfactura');
            $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
