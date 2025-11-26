<?php

namespace App\Exports;

use App\Models\Historial;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Cache;

class HistorialPagoExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public $historial;
    public function __construct()
    {
        $this->historial = Cache::get('historial') ?? Historial::with('pago.cliente', 'pago.prestamo')->get();
        Cache::forget('historial');
    }


    public function collection()
    {
        return $this->historial;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Cliente',
            'Prestamo',
            'Cuota',
            'Vencimiento',
            'Monto Esperado',
            'Monto Pagado',
            'Fecha Pago',
            'Estado',
            'Observaciones',
            'Created At',
            'Updated At',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->pago->cliente->nombre,
            $row->pago->prestamo->codigo,
            $row->pago->numero_cuota,
            $row->pago->vencimiento,
            $row->pago->monto_esperado,
            $row->monto,
            $row->created_at,
            $row->pago->estado,
            $row->pago->observaciones,
            $row->created_at,
            $row->updated_at,
        ];
    }
}
