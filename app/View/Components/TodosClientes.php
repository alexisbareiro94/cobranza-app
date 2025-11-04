<?php

namespace App\View\Components;

use App\Models\Cliente;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class TodosClientes extends Component
{
    /**
     * Create a new component instance.
     */
    public Collection $clientes;
    public function __construct(Collection $clientes)
    {
        $this->clientes = $clientes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.todos-clientes', [
            'cliente' => $this->clientes,
        ]);
    }
}
