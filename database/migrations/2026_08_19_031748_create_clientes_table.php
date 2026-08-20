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


            /* Usuario que registro al cliente */

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();


            /* Datos del cliente */

            $table->string('nombre');

            $table->string('carnet', 20)
                ->unique();

            $table->string('telefono', 20);

            $table->string('direccion')
                ->nullable();


            /* Estado del cliente */

            $table->boolean('estado')
                ->default(true);


            /* Fechas de creacion y actualizacion */

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
