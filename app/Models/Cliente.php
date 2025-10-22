<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
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
        return $this->hasMany(Pago::class, 'cliente_id');
    }
}
