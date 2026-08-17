<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medio extends Model
{
    protected $fillable = ['tipo', 'texto'];

    public static array $tipos = [
        'distincion'      => 'Distinciones',
        'conferencia' => 'Conferencias',
        'podcast'     => 'Podcasts',
        'prensa'      => 'Prensa',
    ];

    public function tipoLabel(): string
    {
        return self::$tipos[$this->tipo] ?? ucfirst($this->tipo);
    }

    public function imagenes(): HasMany
    {
        return $this->hasMany(Imagen::class)->orderBy('orden');
    }

    public function enlaces(): HasMany
    {
        return $this->hasMany(Enlace::class)->orderBy('orden');
    }
}