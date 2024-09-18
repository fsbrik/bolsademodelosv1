<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Confirmacion extends Model
{
    protected $table = 'confirmaciones';

    use HasFactory;

    protected $fillable = [
        'contratacion_id',
        'modelo_id',
        'estado',
    ];

    // Relación con el modelo Contratacion
    public function contratacion(): BelongsTo
    {
        return $this->belongsTo(Contratacion::class);
    }

    // Relación con el modelo Modelo
    public function modelo():BelongsTo
    {
        return $this->belongsTo(Modelo::class);
    }
}
