<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /* Campos que se pueden guardar */

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];


    /* Conversion de tipos */

    protected $casts = [
        'estado' => 'boolean',
    ];
}
