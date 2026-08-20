<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {

            $table->id();


            /* Datos de la categoria */

            $table->string('nombre')
                ->unique();

            $table->string('descripcion')
                ->nullable();


            /* Estado de la categoria */

            $table->boolean('estado')
                ->default(true);


            /* Fechas de creacion y actualizacion */

            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
