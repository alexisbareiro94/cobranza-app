<?php

namespace App\View\Components;

use App\Models\Cliente;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BuscarCliente extends Component
{
    /**
     * Create a new component instance.
     */
    public  $clientes;
    public function __construct()
    {
        $this->clientes = Cliente::where('cobrador_id', auth()->user()->id)->get()->take(3);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buscar-cliente', [
            'clientes' => $this->clientes
        ]);
    }
}
