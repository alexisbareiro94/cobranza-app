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

    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $filters = $this->filters;

        return Historial::with('pago.cliente', 'prestamo')
            ->where('cobrador_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->when($filters['cliente_id'] ?? null, function ($query) use ($filters) {
                return $query->whereHas('pago.cliente', function ($query) use ($filters) {
                    $query->where('clientes.id', $filters['cliente_id']);
                });
            })
            ->when($filters['estado'] ?? null, function ($query) use ($filters) {
                return $query->whereHas('pago', function ($query) use ($filters) {
                    $query->where('estado', $filters['estado']);
                });
            })
            ->when($filters['mes'] ?? null, function ($query) use ($filters) {
                return $query->whereMonth('created_at', $filters['mes']);
            })
            ->when($filters['anio'] ?? null, function ($query) use ($filters) {
                return $query->whereYear('created_at', $filters['anio']);
            })
            ->when($filters['search'] ?? null, function ($query) use ($filters) {
                $search = $filters['search'];
                return $query->whereHas('pago', function ($query) use ($search) {
                    $query->where('codigo', 'like', "%$search%");
                })->orWhereHas('pago.cliente', function ($query) use ($search) {
                    $query->where('clientes.nombre', 'like', "%$search%");
                });
            })
            ->get();
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
