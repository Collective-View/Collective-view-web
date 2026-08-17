<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enlace extends Model
{
    protected $table = 'medio_enlaces';
    protected $fillable = ['medio_id', 'nombre', 'url', 'orden'];

    public function medio(): BelongsTo
    {
        return $this->belongsTo(Medio::class);
    }
}