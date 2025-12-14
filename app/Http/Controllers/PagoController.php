<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePagoRequest;
use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Prestamo;
use App\Models\Historial;
use Barryvdh\DomPDF\Facade\Pdf;

class PagoController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->query('search');
            $desde = $request->query('desde');
            $hasta = $request->query('hasta');

            $pagos = Pago::where('cobrador_id', auth()->user()->id)
                ->with('cliente', 'prestamo')
                ->where('vencimiento', '>', now()->format('Y-m-d'))
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->whereLike('codigo', "%$search%")
                            ->orWhereHas('cliente', function ($q) use ($search) {
                                $q->whereLike('clientes.nombre', "%$search%");
                            });
                    });
                })
                ->when($desde, function ($query) use ($desde) {
                    $query->where('vencimiento', '>=', $desde);
                })
                ->when($hasta, function ($query) use ($hasta) {
                    $query->where('vencimiento', '<=', $hasta);
                })
                ->where('estado', 'pendiente')
                ->orderBy('vencimiento')
                ->get();
            return response()->json([
                'data' => $pagos,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }

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
            // return response()->json([
            //     'data' => $data,
            // ]);
            $pago = Pago::where('codigo', $code)->where('cobrador_id', auth()->user()->id)->first();

            $data['fecha_pago'] = now()->format('Y-m-d');
            $prestamo = Prestamo::findOrFail($pago->prestamo_id);

            // Acumular el monto pagado (para pagos parciales)
            $montoNuevoPago = $data['monto_pagado'];
            $data['monto_pagado'] += $pago->monto_pagado;

            // Actualizar total_pagado y recalcular saldo_pendiente
            $prestamo->total_pagado = ($prestamo->total_pagado ?? 0) + $montoNuevoPago;
            $prestamo->saldo_pendiente = $prestamo->monto_total - $prestamo->total_pagado + ($prestamo->total_mora ?? 0);
            $prestamo->cuotas_pagadas = $data['estado'] == 'pagado' ? $prestamo->cuotas_pagadas + 1 : $prestamo->cuotas_pagadas;

            if ($prestamo->saldo_pendiente <= 0) {
                $prestamo->estado = 'completado';
            }

            $prestamo->save();

            Historial::create([
                'cobrador_id' => auth()->user()->id,
                'prestamo_id' => $pago->prestamo_id,
                'pago_id' => $pago->id,
                'monto' => $montoNuevoPago,
                'estado' => $data['estado'],
            ]);

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
            $montoCobrar = $aCobrar->where('vencimiento', now()->format('Y-m-d'))->sum('monto_esperado');
            $cantidadPagos = $aCobrar->where('vencimiento', now()->format('Y-m-d'))->unique('prestamo_id')->count();

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

    public function pdf($id)
    {
        try {
            $pago = Pago::with('cliente', 'prestamo')
                ->where('cobrador_id', auth()->user()->id)
                ->findOrFail($id);

            $user = auth()->user();
            $configRecibo = $user->configuracionRecibos;

            $pdf = Pdf::loadView('pdf.recibo', [
                'pago' => $pago,
                'user' => $user,
                'configRecibo' => $configRecibo,
            ]);

            $ruta = public_path('recibos/recibo-' . $pago->codigo . '.pdf');

            // Crear la carpeta si no existe
            if (!file_exists(public_path('recibos'))) {
                mkdir(public_path('recibos'), 0777, true);
            }

            // Guardar el archivo
            file_put_contents($ruta, $pdf->output());

            // (Opcional) descargarlo
            return response()->download($ruta);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function whatsapp($id)
    {
        try {
            $pago = Pago::with('cliente', 'prestamo')
                ->where('cobrador_id', auth()->user()->id)
                ->findOrFail($id);

            $user = auth()->user();
            $configRecibo = $user->configuracionRecibos;

            $pdf = Pdf::loadView('pdf.recibo', [
                'pago' => $pago,
                'user' => $user,
                'configRecibo' => $configRecibo,
            ]);

            $ruta = public_path('recibos/recibo-' . $pago->codigo . '.pdf');

            // Crear la carpeta si no existe
            if (!file_exists(public_path('recibos'))) {
                mkdir(public_path('recibos'), 0777, true);
            }

            // Guardar el archivo
            file_put_contents($ruta, $pdf->output());

            // (Opcional) descargarlo
            return response()->download($ruta);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
