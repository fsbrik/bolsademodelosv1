<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Foto extends Model
{
    use HasFactory;
    protected $guarded = [];

    // app/Models/Foto.php
    public function modelo(): BelongsTo
    {
        return $this->belongsTo(Modelo::class);
    }
}
