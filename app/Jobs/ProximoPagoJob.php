<?php

namespace App\Jobs;

use App\Models\Pago;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProximoPagoJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pagos = Pago::where('estado', 'pendiente')->get();
        foreach($pagos as $pago){
            if($pago->vencimiento < now()->format('Y-m-d')){
                $pago->update([
                    'estado' => 'no_pagado',
                ]);
            }
        }
    }
}
