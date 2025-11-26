<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Historial;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateHistorialRequest;
use App\Models\Pago;

class HistorialController extends Controller
{
    public function index_view()
    {
        $historial = Historial::with('pago.cliente', 'prestamo')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('historial.index', [
            'historial' => $historial
        ]);
    }

    public function index()
    {
        try {
            $historial = Historial::with('pago.cliente', 'prestamo')->get()->take(10);
            return response()->json([
                'data' => $historial
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
