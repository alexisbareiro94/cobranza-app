<?php

namespace App\Http\Controllers;

use App\Models\{Cliente, Prestamo};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $prestamos = Prestamo::with(['pagos', 'cliente', 'proximo_pago'])
            ->where('cobrador_id', auth()->user()->id)
            ->whereHas('proximo_pago', function ($q) {
                return $q->where('vencimiento', '<=', now()->startOfDay());
            })
            ->get();

        $cantidad = $prestamos->count();

        $clientes = Cliente::where('cobrador_id', auth()->user()->id)
            ->orderByDesc('created_at')
            ->get()
            ->take(4);

        return view('dashboard', [
            'clientes' => $clientes,
            'prestamos' => $prestamos,
            'cantidad' => $cantidad,
        ]);
    }
}
