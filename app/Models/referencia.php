<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    protected $fillable = [
        'titulo',
        'autores',
        'anio',
        'revista',
        'resumen',
        'url',
        'doi',
        'palabras_clave',
    ];
}