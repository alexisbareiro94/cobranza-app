<?php

namespace App\Http\Controllers;

use App\Models\{Cliente, Prestamo, Pago, Historial, Auditoria};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        //TODO: agregar un scheduler para que esto se ejecute diariamente
        $vencidos = Pago::with('prestamo')
            ->where('estado', 'pendiente')
            ->where('cobrador_id', auth()->user()->id)
            ->whereDate('vencimiento', '<', now()->format('Y-m-d'))
            ->get();

        if ($vencidos->isNotEmpty()) {
            // $ids = $vencidos->select('id', 'monto_esperado', 'monto_mora');
            $data = $vencidos->map(function ($pago) {
                return [
                    'id' => $pago->id,
                    'monto_esperado' => $pago->monto_esperado,
                    'monto_mora' => $pago->prestamo->monto_mora,
                ];
            });

            $historialData = $vencidos->map(function ($pago) {
                return [
                    'cobrador_id' => $pago->cobrador_id,
                    'prestamo_id' => $pago->prestamo_id,
                    'pago_id' => $pago->id,
                    'monto' => 0,
                    'estado' => 'no_pagado',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();

            Historial::insert($historialData);

            foreach ($data as $item) {
                $pago = Pago::where('id', $item['id'])->first();
                $pago->update([
                    'estado' => 'no_pagado',
                    'monto_esperado' => $item['monto_esperado'] + $item['monto_mora'],
                ]);
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
