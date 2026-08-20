<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cliente extends Model
{
    /* Campos que se pueden guardar */

    protected $fillable = [
        'user_id',
        'nombre',
        'carnet',
        'telefono',
        'direccion',
        'estado',
    ];


    /* Conversion de tipos */

    protected $casts = [
        'estado' => 'boolean',
    ];


    /* Usuario que registro al cliente */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
