<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\{Prestamo, Pago};
use Illuminate\Support\Facades\DB;

class PrestamoService
{
    public function process_pagos(Prestamo $prestamo, array $fechas) 
    {   
        DB::beginTransaction();
        try{
            $cont = 1;
            $pagos = [0];
            foreach($fechas as $fecha){
                $pagos[] = Pago::create([
                    'prestamo_id' => $prestamo->id,
                    'codigo' => set_code(),
                    'cobrador_id' => auth()->user()->id,
                    'monto_pagado' => 0,
                    'monto_esperado' => $prestamo->monto_cuota,
                    'numero_cuota' => $cont,
                    'estado' => 'pendiente',
                    'vencimiento' => $fecha,
                    'observaciones' => null,
                ]);
                $cont++;
            }
            DB::commit();
            return $pagos;
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}
