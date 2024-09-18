<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Modelo extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($modelo) {
            if ($modelo->user->modelo) {
                // Manejar la situación y mostrar un mensaje de error
                throw new \Exception('Ya tienes un perfil de modelo creado');
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fotos(): HasMany
    {
        return $this->hasMany(Foto::class);
    }

    // Relación de muchos a muchos con Contratacion
    public function contrataciones(): BelongsToMany
    {
        return $this->belongsToMany(Contratacion::class);
    }

    // Definir la relación inversa de muchos a uno con Confirmacion
    public function confirmaciones(): HasMany
    {
        return $this->hasMany(Confirmacion::class);
    }

}
