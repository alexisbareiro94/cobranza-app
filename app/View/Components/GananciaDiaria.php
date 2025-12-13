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
        $pagos = Pago::where('fecha_pago', now()->format('Y-m-d'))
            ->where('cobrador_id', auth()->id())
            ->get();
        $aCobrar = Pago::where('vencimiento', '<=', now()->format('Y-m-d'))
            ->where('cobrador_id', auth()->id())
            ->get();
        $this->cobrado = $pagos->sum('monto_pagado');
        $this->pagosCompletados = $pagos->unique('prestamo_id')->count();
        $this->montoCobrar = $aCobrar->where('vencimiento', now()->format('Y-m-d'))->sum('monto_esperado');
        $this->cantidadPagos = $aCobrar->where('vencimiento', now()->format('Y-m-d'))->unique('prestamo_id')->count();

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
