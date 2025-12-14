<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguracionRecibo extends Model
{
    protected $table = 'configuracion_recibos';

    protected $fillable = [
        'user_id',
        'logo_path',
        'info_contacto',
        'mensaje_personalizado',
        'pie_pagina',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
