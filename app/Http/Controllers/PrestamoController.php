<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrestramoRequest;
use App\Models\Cliente;
use App\Models\Prestamo;
use App\Services\PrestamoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
{
    public function __construct(protected PrestamoService $prestamoService) {}

    public function index()
    {
        try {
            $prestamos = Prestamo::with(['pagos', 'cliente', 'proximo_pago'])
                ->where('cobrador_id', auth()->user()->id)
                ->whereHas('proximo_pago', function ($q) {
                    return $q->where('vencimiento', '<=', now()->startOfDay());
                })
                ->get();

            return response()->json([
                'data' => $prestamos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function store(StorePrestramoRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $cliente = Cliente::findOrFail($data['cliente_id']);
            $cliente->update(['activo' => true]);

            // Cálculos de interés
            $interes = $data['monto_prestado'] * ($data['porcentaje_interes'] / 100);
            $data['monto_total'] = $data['monto_prestado'] + $interes;

            // Recalcular cuota para asegurar precisión -- ELIMINADO A PEDIDO DEL USUARIO
            // if (isset($data['cantidad_cuotas']) && $data['cantidad_cuotas'] > 0) {
            //     $data['monto_cuota'] = round($data['monto_total'] / $data['cantidad_cuotas']);
            // }

            $data['cuotas_pagadas'] = 0;
            $data['saldo_pendiente'] = $data['monto_total'];
            $data['estado'] = 'activo';
            $data['codigo'] = set_code();
            $data['cobrador_id'] = auth()->user()->id;
            $prestamo = Prestamo::create($data);
            $res = $this->prestamoService->process_pagos($prestamo, $data['fechas']);
            if (!is_array($res)) {
                DB::rollBack();
                return response()->json([
                    'error' => $res
                ], 400);
            }
            DB::commit();
            return response()->json([
                'message' => 'Prestamo Creado'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}
