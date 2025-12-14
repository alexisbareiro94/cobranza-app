<?php

namespace App\Traits;

use App\Models\Auditoria;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function ($model) {
            self::audit('crear', $model);
        });

        static::updated(function ($model) {
            self::audit('actualizar', $model);
        });

        static::deleted(function ($model) {
            self::audit('eliminar', $model);
        });
    }

    protected static function audit($accion, $model)
    {
        Auditoria::create([
            'user_id' => auth()->user()->id ?? null,
            'cobrador_id' => auth()->user()->id ?? null,
            'accion' => $accion,
            'modelo_afectado' => get_class($model),
            'registro_id' => $model->id,
            'datos_anteriores' => $accion === 'actualizar' || $accion === 'eliminar' ? $model->getOriginal() : null,
            'datos_nuevos' => $accion === 'actualizar' || $accion === 'crear' ? $model->getAttributes() : null,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
