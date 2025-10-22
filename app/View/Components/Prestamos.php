<?php

namespace App\View\Components;

use App\Models\Prestamo;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Prestamos extends Component
{
    /**
     * Create a new component instance.
     */
    public Prestamo $prestamo;
    public function __construct(Prestamo $prestamo)
    {
        $this->prestamo = $prestamo;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.prestamos', [
            'prestamo' => $this->prestamo,
        ]);
    }
}
