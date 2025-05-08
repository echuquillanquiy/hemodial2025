<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    use HasFactory;

    protected $fillable = [
        'orden_id',
        'hora_inicial',
        'peso_inicial',
        'pa_inicial',
        'frecuencia_cardiaca',
        'saturacion_so2',
        'fio2',
        'temperatura',
        'problemas_clinicos',
        'evaluacion',
        'indicaciones',
        'signos_sintomas',
        'epoetina_alfa_2000',
        'epoetina_alfa_4000',
        'hierro',
        'hidroxicobalamina',
        'calcitriol',
        'hora_hd',
        'heparina',
        'peso_seco',
        'uf',
        'qb',
        'qd',
        'bicarbonato',
        'na_inicial',
        'cnd',
        'na_final',
        'perfil_na',
        'area_filtro',
        'membrana',
        'perfil_uf',
        'evaluacion_final',
        'hora_final',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Orden::class);
    }

    public function usuarioInicio(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_inicio_hd');
    }

    public function usuarioFinaliza(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_finaliza_hd');
    }
}
