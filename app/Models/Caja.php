<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = 'cajas';

    protected $fillable = [
        'cobrador_id',
        'saldo_inicial',
        'total_cobrado',
        'estado'
    ];

    public function cobrador()
    {
        return $this->belongsTo(User::class, 'cobrador_id');
    }
}
