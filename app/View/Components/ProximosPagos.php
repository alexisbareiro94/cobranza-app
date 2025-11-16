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
        $this->pagos = Pago::where('cobrador_id', auth()->user()->id)->with('prestamo')->get();        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.proximos-pagos', [
            'prestamo' => $this->pagos,
        ]);
    }
}
