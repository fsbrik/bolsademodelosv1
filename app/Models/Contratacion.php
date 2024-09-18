<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contratacion extends Model
{
    protected $table = 'contrataciones';
    protected $guarded = [];
    use HasFactory;

    // Definir la relación inversa de muchos a uno con Empresa
    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    // Relación de muchos a muchos con Modelo
    public function modelos(): BelongsToMany
    {
        return $this->belongsToMany(Modelo::class, 'contratacion_modelo', 'contratacion_id', 'modelo_id');
    }

    // Definir la relación inversa de muchos a uno con Confirmacion
    public function confirmaciones(): HasMany
    {
        return $this->hasMany(Confirmacion::class);
    }

}
