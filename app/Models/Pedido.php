<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;

class Pedido extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['fec_ini', 'fec_fin'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function servicios(): BelongsToMany
    {
        return $this->belongsToMany(Servicio::class)->withPivot('cantidad')->withTimestamps();
    }
}
