<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class RutaController extends Controller
{
    public function index_view()
    {
        return view('rutas.index');
    }

    public function index()
    {
        try{
            $clientes = Cliente::select('id', 'nombre', 'geo')->get();
            
            $map = [];
            foreach ($clientes as $cliente) {
                list($lat, $lng) = explode(', ', $cliente->geo);
                $map[] = [
                    'lat' => $lat,
                    'lng' => $lng,
                    'cliente' => $cliente->nombre
                ];
            }
            return response()->json([
                'data' => $map,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
