<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrestramoRequest;
use App\Models\Prestamo;
use App\Services\PrestamoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
{
    public function __construct(protected PrestamoService $prestamoService){}


    public function index(Request $request)
    {
        $prestamo = Prestamo::with('pagos', 'cliente', 'proximo_pago')->where('cobrador_id', auth()->user()->id)->get();
        return $prestamo;
    }

    public function store(StorePrestramoRequest $request){
        DB::beginTransaction();
        try{
            $data = $request->validated();
            $data['cuotas_pagadas'] = 0;
            $data['saldo_pendiente'] = $data['monto_total'];
            $data['estado'] = 'activo';
            $data['codigo'] = set_code();
            $data['cobrador_id'] = auth()->user()->id;            
            $prestamo = Prestamo::create($data);
            $res = $this->prestamoService->process_pagos($prestamo, $data['fechas']);
            if(!is_array($res)){
                DB::rollBack();
                return response()->json([
                    'error' => $res
                ], 400);
            }
            DB::commit();
            return response()->json([
                'message' => 'Prestamo Creado'
            ]);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}
