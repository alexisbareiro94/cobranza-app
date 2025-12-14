<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Auditable;

class Prestamo extends Model
{
    use Auditable;

    protected $table = 'prestamos';

    protected $fillable = [
        'cliente_id',
        'cobrador_id',
        'monto_total',
        'monto_cuota',
        'cantidad_cuotas',
        'cuotas_pagadas',
        'saldo_pendiente',
        'fecha_inicio',
        'fecha_fin_estimado',
        'estado',
        'rango',
        'observaciones',
        'codigo',
        'monto_prestado',
        'porcentaje_interes',
        'monto_mora'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function cobrador()
    {
        return $this->belongsTo(User::class, 'cobrador_id');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'prestamo_id')->orderBy('numero_cuota');
    }

    public function proximo_pago()
    {
        return $this->hasOne(Pago::class, 'prestamo_id')
            ->where(function ($q) {
                $q->where('estado', 'no_pagado')
                    ->orWhere('estado', 'parcial')
                    ->orWhere('estado', 'pendiente');
            })
            ->orderBy('numero_cuota');
    }

    public function historial()
    {
        return $this->hasMany(Historial::class, 'prestamo_id');
    }
}
