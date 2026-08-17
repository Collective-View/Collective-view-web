<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Imagen extends Model
{
    protected $table = 'medio_imagenes';
    protected $fillable = ['medio_id', 'ruta', 'orden'];

    public function medio(): BelongsTo
    {
        return $this->belongsTo(Medio::class);
    }
}