<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    protected $table = 'historiales';

    protected $fillable = [
        'cobrador_id',
        'prestamo_id',
        'pago_id',
        'monto',
    ];

    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class);
    }
}
