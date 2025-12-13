<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Auditable;

class Cliente extends Model
{
    use Auditable;

    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'cobrador_id',
        'correo',
        'telefono',
        'direccion',
        'geo',
        'imagen',
        'activo',
        'referencia',
        'nro_ci',
        'ciudad',
    ];

    public function cobrador()
    {
        return $this->belongsTo(User::class);
    }

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'cliente_id');
    }

    public function pagos()
    {
        return $this->hasManyThrough(Pago::class, Prestamo::class, 'cliente_id', 'prestamo_id');
    }
}
