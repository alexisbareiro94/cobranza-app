<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguracionPrestamo extends Model
{
    protected $table = 'configuracion_prestamos';

    protected $fillable = [
        'user_id',
        'tasa_interes_default',
        'monto_mora_default',
        'monto_minimo',
        'monto_maximo',
        'cuotas_minimas',
        'cuotas_maximas',
        'dias_gracia',
    ];

    protected $casts = [
        'tasa_interes_default' => 'decimal:2',
        'monto_mora_default' => 'integer',
        'monto_minimo' => 'integer',
        'monto_maximo' => 'integer',
        'cuotas_minimas' => 'integer',
        'cuotas_maximas' => 'integer',
        'dias_gracia' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
