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
        Schema::create('deta_cotizas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cotizaciones_id')->constrained('cotizaciones')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('inventarios_id')->constrained('inventarios')->restrictOnUpdate()->restrictOnDelete();
            $table->float('cantidad');
            $table->float('valor');
            $table->float('subtotal');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deta__cotizaciones');
    }
};
