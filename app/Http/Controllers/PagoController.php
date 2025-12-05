<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePagoRequest;
use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Prestamo;
use App\Models\Historial;

class PagoController extends Controller
{
    public function show(string $id)
    {
        try {
            $pago = Pago::with('cliente', 'prestamo')->where('cobrador_id', auth()->user()->id)->findOrFail($id);
            return response()->json([
                'data' => $pago
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function update(UpdatePagoRequest $request, string $code)
    {
        try {
            $data = $request->validated();
            $pago = Pago::where('codigo', $code)->where('cobrador_id', auth()->user()->id)->first();

            $data['fecha_pago'] = now()->format('Y-m-d');
            $prestamo = Prestamo::findOrFail($pago->prestamo_id);
            $prestamo->update([
                'saldo_pendiente' => $prestamo->saldo_pendiente -= $data['monto_pagado'],
                'cuotas_pagadas' => $data['estado'] == 'pagado' ? $prestamo->cuotas_pagadas += 1 : $prestamo->cuotas_pagadas,
            ]);

            Historial::create([
                'cobrador_id' => auth()->user()->id,
                'prestamo_id' => $pago->prestamo_id,
                'pago_id' => $pago->id,
                'monto' => $data['monto_pagado'],
            ]);

            $data['monto_pagado'] += $pago->monto_pagado;

            $pago->update($data);
            return response()->json([
                'message' => 'pago acuatizado',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function ganancias()
    {
        try {
            $pagos = Pago::where('fecha_pago', now()->format('Y-m-d'))
                ->where('cobrador_id', auth()->id())
                ->get();
            $aCobrar = Pago::where('vencimiento', '<=', now()->format('Y-m-d'))
                ->where('cobrador_id', auth()->id())
                ->get();
            $cobrado = $pagos->sum('monto_pagado');
            $pagosCompletados = $pagos->unique('prestamo_id')->count();
            $montoCobrar = $aCobrar->where('fecha_pago', '==', now()->format('Y-m-d'))->sum('monto_esperado');
            $cantidadPagos = $aCobrar->unique('prestamo_id')->count();

            return response()->json([
                'cobrado' => $cobrado,
                'pagosCompletados' => $pagosCompletados,
                'montoCobrar' => $montoCobrar,
                'cantidadPagos' => $cantidadPagos,

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
