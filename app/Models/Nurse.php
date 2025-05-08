<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    use HasFactory;
    protected $fillable = [
        'orden_id',
        'h_cl',
        'frecuencia_hd',
        'puesto',
        'aspecto_dializador',
        'pa_inicial',
        'pa_final',
        'peso_inicial',
        'peso_final',
        'nro_maquina',
        'marca_modelo',
        'filtro',
        'uif',
        'hierro',
        'epo_2000',
        'epo_4000',
        'hidroxicobalamina',
        'calcitriol',
        'otros_medicamentos',
        's_',
        'o_',
        'a_',
        'p_',
        'observacion_final',
        'usuario_atencion',
        'usuario_finaliza_hd',
    ];

    /**
     * Obtiene la orden asociada a este reporte de enfermería.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Obtiene el paciente asociado a este reporte de enfermería a través de la orden.
     */
    public function patient(): BelongsTo
    {
        return $this->orden->patient();
    }

    /**
     * Obtiene el usuario que atendió la hemodiálisis.
     */
    public function usuarioAtencion(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_atencion');
    }

    /**
     * Obtiene el usuario que finalizó la hemodiálisis.
     */
    public function usuarioFinaliza(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_finaliza_hd');
    }
}
