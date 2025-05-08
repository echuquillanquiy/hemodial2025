<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'orden_id',
        'hr',
        'pa',
        'fc',
        'qb',
        'cnd',
        'ra',
        'rv',
        'ptm',
        'sol_hemoderivados',
        'observacion',
    ];

    /**
     * Obtiene la orden asociada a este tratamiento.
     */
    public function orden(): BelongsTo
    {
        return $this->belongsTo(Orden::class);
    }
}
