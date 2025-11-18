<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePagoRequest;
use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Prestamo;

class PagoController extends Controller
{
    public function show(string $id){
        try{
            $pago = Pago::with('cliente', 'prestamo')->where('cobrador_id', auth()->user()->id)->findOrFail($id);            
            return response()->json([
                'data' => $pago
            ]);
        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }        
    }

    public function update(UpdatePagoRequest $request, string $code){        
        try{
            $data = $request->validated();
            $pago = Pago::where('codigo', $code)->where('cobrador_id', auth()->user()->id)->first();
            $data['fecha_pago'] = now()->format('Y-m-d');
            $prestamo = Prestamo::findOrFail($pago->prestamo_id);            
            $prestamo->update([
                'saldo_pendiente' => $prestamo->saldo_pendiente -= $data['monto_pagado'],               
                'cuotas_pagadas' => $data['estado'] == 'pagado' ? $prestamo->cuotas_pagadas += 1 : $prestamo->cuotas_pagadas,
            ]);

            $data['monto_pagado'] += $pago->monto_pagado;

            $pago->update($data);
            return response()->json([
                'message' => 'pago acuatizado',                
            ]);
        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
