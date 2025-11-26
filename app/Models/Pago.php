<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';

    protected $fillable = [
        'prestamo_id',
        'cobrador_id',
        'monto_pagado',
        'monto_esperado',
        'numero_cuota',
        'estado', //'pagado', 'parcial', 'no_pagado', 'pendiente'
        'vencimiento',
        'observaciones',
        'fecha_pago',
        'codigo',
    ];

    public function cliente()
    {
        return $this->hasOneThrough(Cliente::class, Prestamo::class, 'id', 'id', 'prestamo_id', 'cliente_id');
    }

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class);
    }

    public function historial()
    {
        return $this->hasMany(Historial::class, 'pago_id');
    }
}
