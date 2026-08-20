<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    /* Campos que se pueden guardar */
    protected $fillable = [
        'user_id',
        'categoria_id',
        'nombre',
        'unidad_medida',
        'precio_actual',
        'stock',
        'descripcion',
        'estado',
    ];


    /* Conversion de tipos */
    protected $casts = [
        'precio_actual' => 'decimal:2',
        'stock' => 'integer',
        'estado' => 'boolean',
    ];


    /* Usuario que registro el producto */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /* Categoria del producto */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
}