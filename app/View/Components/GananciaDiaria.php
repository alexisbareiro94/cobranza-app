<?php

namespace App\View\Components;

use App\Models\Pago;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GananciaDiaria extends Component
{
    /**
     * Create a new component instance.
     */

    public $cobrado;
    public $montoCobrar;
    public $cantidadPagos;
    public $pagosCompletados;

    public function __construct()
    {
        // Pagos que fueron cobrados hoy (tienen fecha_pago = hoy)
        $pagos = Pago::where('fecha_pago', now()->format('Y-m-d'))
            ->where('cobrador_id', auth()->id())
            ->get();

        // Pagos pendientes que vencen hasta hoy (incluye pendientes y no_pagados)
        $aCobrar = Pago::where('vencimiento', '<=', now()->format('Y-m-d'))
            ->where('cobrador_id', auth()->id())
            ->whereIn('estado', ['pendiente', 'no_pagado'])
            ->get();

        // Total cobrado hoy
        $this->cobrado = $pagos->sum('monto_pagado');

        // Cantidad de préstamos únicos que tuvieron pagos hoy
        $this->pagosCompletados = $pagos->unique('prestamo_id')->count();

        // Monto total que falta cobrar (de pagos vencidos hasta hoy)
        $this->montoCobrar = $aCobrar->sum('monto_esperado');

        // Cantidad de préstamos únicos con pagos pendientes hasta hoy
        $this->cantidadPagos = $aCobrar->unique('prestamo_id')->count();

        // dd([
        //     'pagos' =>  $pagos,
        //     'aCobrar' => $aCobrar,
        //     'cobrado' => $this->cobrado,
        //     'pagosCompletados' => $this->pagosCompletados,
        //     'montoCobrar' => $this->montoCobrar,
        //     'cantidadPagos' => $this->cantidadPagos
        // ]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ganancia-diaria', [
            'monto' => $this->cobrado,
            'cantidad' => $this->cantidadPagos,
            'montoCobrar' => $this->montoCobrar,
            'prestamosPagados' => $this->pagosCompletados,
        ]);
    }
}
