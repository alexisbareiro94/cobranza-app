<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Historial;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateHistorialRequest;
use App\Models\Pago;
use App\Models\Cliente;

class HistorialController extends Controller
{
    public function index_view()
    {
        $historial = Historial::with('pago.cliente', 'prestamo')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $clientes = Cliente::where('cobrador_id', auth()->user()->id)->get();
        return view('historial.index', [
            'historial' => $historial,
            'clientes' => $clientes
        ]);
    }

    public function index(Request $request)
    {
        try {
            $clienteId = $request->query('cliente_id') ?? null;
            $estado = $request->query('estado') ?? null;
            $mes = $request->query('mes') ?? null;
            $anio = $request->query('anio') ?? null;
            $search = $request->query('q') ?? null;
            $paginacion = false;

            $historial = Historial::with('pago.cliente', 'prestamo')
                ->where('cobrador_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->when($clienteId, function ($query) use ($clienteId) {
                    return $query->whereHas('pago.cliente', function ($query) use ($clienteId) {
                        $query->where('clientes.id', $clienteId);
                    });
                })
                ->when($estado, function ($query) use ($estado) {
                    return $query->whereHas('pago', function ($query) use ($estado) {
                        $query->where('estado', $estado);
                    });
                })
                ->when($mes, function ($query) use ($mes) {
                    return $query->whereMonth('created_at', $mes);
                })
                ->when($anio, function ($query) use ($anio) {
                    return $query->whereYear('created_at', $anio);
                })
                ->when($search, function ($query) use ($search) {
                    return $query->whereHas('pago', function ($query) use ($search) {
                        $query->whereLike('codigo', "%$search%");
                    })->orWhereHas('pago.cliente', function ($query) use ($search) {
                        $query->whereLike('clientes.nombre', "%$search%");
                    });
                });

            if (!filled($search) && !filled($clienteId) && !filled($estado) && !filled($mes) && !filled($anio)) {
                $historial = $historial->get()->take(10);
                $paginacion = true;
            } else {
                $historial = $historial->get();
            }

            return response()->json([
                'data' => $historial,
                'paginacion' => $paginacion
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function show(string $id)
    {
        try {
            $historial = Historial::with('pago.cliente', 'prestamo')->findOrFail($id);

            return response()->json([
                'data' => $historial
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function update(UpdateHistorialRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $historial = Historial::findOrFail($id);
            $historial->update($data);

            $montoPagado = Historial::where('pago_id', $historial->pago_id)->pluck('monto')->sum();

            $pago = Pago::findOrFail($historial->pago_id);
            $pago->update([
                'monto_pagado' => $montoPagado
            ]);

            DB::commit();
            return response()->json([
                'data' => [
                    'historial' => $historial,
                    'pago' => $pago,
                    'montoPagado' => $montoPagado
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
