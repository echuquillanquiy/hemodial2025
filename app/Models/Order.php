<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'sala',
        'turno',
        'covid',
        'hd',
        'fua',
        'fecha_creacion',
        'tipo_procedimiento',
        'incluye_laboratorio',
        'numero_sesion',
        'hora_inicial',
        'peso_inicial',
        'peso_final',
    ];
}
