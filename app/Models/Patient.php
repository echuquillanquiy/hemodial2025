<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'primer_nombre',
        'otros_nombres',
        'primer_apellido',
        'segundo_apellido',
        'dni',
        'secuencia',
        'turno',
        'modulo',
        'peso_seco',
        'acceso_arterial',
        'acceso_venoso',
        'estado',
        'codigo_cs',
        'n_hd',
        'n_historia',
        'justificacion',
    ];
}
