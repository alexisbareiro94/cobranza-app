<?php

namespace App\View\Components;

use App\Models\Pago;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProximosPagos extends Component
{
    /**
     * Create a new component instance.
     */
    public $pagos;
    public function __construct()
    {
        $this->pagos = Pago::where('cobrador_id', auth()->user()->id)
            ->where('estado', 'pendiente')
            ->with('prestamo.proximo_pago', 'cliente')            
            ->orderBy('vencimiento')
            ->get();      
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.proximos-pagos', [
            'prestamos' => $this->pagos,
        ]);
    }
}
