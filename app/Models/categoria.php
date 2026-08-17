<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre'];

    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class);
    }
}