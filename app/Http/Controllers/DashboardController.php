<?php

namespace App\Http\Controllers;

use App\Models\{Cliente, Prestamo, Pago, Historial};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        //TODO: agregar un scheduler para que esto se ejecute diariamente
        if (!session()->has('query_pagos')) {
            $vencidos = Pago::where('estado', 'pendiente')
                ->whereDate('vencimiento', '<', now()->format('Y-m-d'))
                ->get();

            if ($vencidos->isNotEmpty()) {
                $ids = $vencidos->pluck('id');

                $historialData = $vencidos->map(function ($pago) {
                    return [
                        'cobrador_id' => $pago->cobrador_id,
                        'prestamo_id' => $pago->prestamo_id,
                        'pago_id' => $pago->id,
                        'monto' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                })->toArray();

                Historial::insert($historialData);

                Pago::whereIn('id', $ids)->update(['estado' => 'no_pagado']);
                session()->put('query_pagos', true);
            }
        }
    }

    public function index()
    {
        $prestamos = Prestamo::with(['pagos', 'cliente', 'proximo_pago'])
            ->where('cobrador_id', auth()->user()->id)
            ->whereHas('proximo_pago', function ($q) {
                return $q->where('vencimiento', '<=', now()->startOfDay());
            })
            ->get();

        $cantidad = $prestamos->count();

        $clientes = Cliente::where('cobrador_id', auth()->user()->id)
            ->orderByDesc('created_at')
            ->get()
            ->take(4);

        return view('dashboard', [
            'clientes' => $clientes,
            'prestamos' => $prestamos,
            'cantidad' => $cantidad,
        ]);
    }
}
