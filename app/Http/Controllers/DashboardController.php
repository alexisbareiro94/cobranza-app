<?php

namespace App\Http\Controllers;

use App\Models\{Cliente, Prestamo, Pago, Historial, Auditoria};
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        //TODO: agregar un scheduler para que esto se ejecute diariamente
        //TODO: ver tambien si sigue en "no_pagado" y volver a aumentar el monto por mora
        if (session()->has('query_vencidos')) {
            return;
        }
        $vencidos = Pago::with('prestamo')
            ->where(function ($q) {
                $q->where('estado', 'pendiente')
                    ->orWhere('estado', 'no_pagado');
            })
            ->where('cobrador_id', auth()->user()->id)
            ->whereDate('vencimiento', '<', now()->format('Y-m-d'))
            ->get();

        if ($vencidos->isNotEmpty()) {
            $data = $vencidos->map(function ($pago) {
                return [
                    'pago_id' => $pago->id,
                    'prestamo_id' => $pago->prestamo_id,
                    'monto_esperado' => $pago->monto_esperado,
                    'monto_mora' => $pago->prestamo->monto_mora,
                    'dias' => round(Carbon::parse($pago->vencimiento)->diffInDays(now()))
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

            // Agrupar por prestamo_id para actualizar total_mora
            $prestamosMora = [];

            foreach ($data as $item) {
                $pago = Pago::where('id', $item['pago_id'])->first();
                $mora_acumulada = $item['monto_mora'] * $item['dias'];

                $pago->update([
                    'estado' => 'no_pagado',
                    'monto_esperado' => $item['monto_esperado'] + $mora_acumulada,
                ]);

                // Acumular mora por prestamo
                if (!isset($prestamosMora[$item['prestamo_id']])) {
                    $prestamosMora[$item['prestamo_id']] = 0;
                }
                $prestamosMora[$item['prestamo_id']] += $mora_acumulada;
            }

            // Actualizar total_mora y saldo_pendiente en cada prestamo
            foreach ($prestamosMora as $prestamo_id => $mora_total) {
                $prestamo = Prestamo::find($prestamo_id);
                if ($prestamo) {
                    $prestamo->total_mora = ($prestamo->total_mora ?? 0) + $mora_total;
                    $prestamo->saldo_pendiente = $prestamo->monto_total - $prestamo->total_pagado + $prestamo->total_mora;
                    $prestamo->save();
                }
            }

            session()->put('query_vencidos', true);
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

        // Cargar configuración de préstamos del usuario
        $user = auth()->user();
        $configPrestamos = $user->configuracionPrestamos;

        return view('dashboard', [
            'clientes' => $clientes,
            'prestamos' => $prestamos,
            'cantidad' => $cantidad,
            'configPrestamos' => $configPrestamos,
        ]);
    }
}
