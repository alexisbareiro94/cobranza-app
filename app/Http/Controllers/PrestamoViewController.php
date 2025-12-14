<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Cliente;
use Illuminate\Http\Request;

class PrestamoViewController extends Controller
{
    public function index(Request $request)
    {
        $query = Prestamo::with(['cliente', 'cobrador', 'pagos'])
            ->where('cobrador_id', auth()->user()->id);

        // Filtro por estado
        if ($request->has('estado') && $request->estado != '') {
            $query->where('estado', $request->estado);
        }

        // Filtro por cliente
        if ($request->has('cliente_id') && $request->cliente_id != '') {
            $query->where('cliente_id', $request->cliente_id);
        }

        // Búsqueda por código
        if ($request->has('codigo') && $request->codigo != '') {
            $query->where('codigo', 'like', '%' . $request->codigo . '%');
        }

        $prestamos = $query->orderBy('created_at', 'desc')->paginate(15);

        $clientes = Cliente::where('cobrador_id', auth()->user()->id)->get();

        return view('prestamos.index', [
            'prestamos' => $prestamos,
            'clientes' => $clientes
        ]);
    }

    public function show($id)
    {
        $prestamo = Prestamo::with(['cliente', 'cobrador', 'pagos', 'historial.pago'])
            ->where('cobrador_id', auth()->user()->id)
            ->findOrFail($id);

        return view('prestamos.detalle', [
            'prestamo' => $prestamo
        ]);
    }
}
