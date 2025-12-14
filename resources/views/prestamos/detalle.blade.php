@extends('layouts.app')

@section('title', 'Detalle del Préstamo')

@section('content')
    <div id="detalle-prestamo-container" class="fade-in">
        <!-- Botón de regresar -->
        <div class="mb-4">
            <a href="{{ route('prestamos.index') }}"
                class="p-4 inline-flex items-center text-green-600 hover:text-green-800 font-semibold transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Volver al Historial
            </a>
        </div>

        <!-- Información General del Préstamo -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Préstamo #{{ $prestamo->codigo }}</h2>
                    <p class="text-gray-600 mt-1">Cliente: <span
                            class="font-semibold">{{ $prestamo->cliente->nombre }}</span>
                    </p>
                </div>
                <span @class([
                    'text-sm px-4 py-2 rounded-full font-semibold',
                    'bg-green-100 text-green-700' => $prestamo->estado == 'activo',
                    'bg-blue-100 text-blue-700' => $prestamo->estado == 'completado',
                    'bg-red-100 text-red-700' => $prestamo->estado == 'cancelado',
                    'bg-yellow-100 text-yellow-700' => $prestamo->estado == 'moroso',
                ])>
                    {{ ucfirst($prestamo->estado) }}
                </span>
            </div>

            <!-- Tarjetas de Resumen -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Monto Prestado -->
                <div class="bg-blue-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Monto Prestado</p>
                    <p class="text-2xl font-bold text-blue-700">
                        Gs. {{ number_format($prestamo->monto_prestado ?? 0, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Monto Total (Original) -->
                <div class="bg-purple-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Monto Total (Original)</p>
                    <p class="text-2xl font-bold text-purple-700">
                        Gs. {{ number_format($prestamo->monto_total, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        Interés: {{ number_format($prestamo->porcentaje_interes ?? 0, 0) }}%
                    </p>
                </div>

                <!-- Total Pagado -->
                <div class="bg-green-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Total Pagado</p>
                    <p class="text-2xl font-bold text-green-700">
                        Gs. {{ number_format($prestamo->total_pagado ?? 0, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        Cuotas: {{ $prestamo->cuotas_pagadas }}/{{ $prestamo->cantidad_cuotas }}
                    </p>
                </div>

                <!-- Saldo Pendiente -->
                <div class="bg-orange-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Saldo Pendiente</p>
                    <p class="text-2xl font-bold text-orange-700">
                        Gs. {{ number_format($prestamo->saldo_pendiente, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        Mora: Gs. {{ number_format($prestamo->total_mora ?? 0, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <!-- Detalles Adicionales -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 border-t border-gray-200">
                <div>
                    <p class="text-sm text-gray-600">Fecha de Inicio</p>
                    <p class="font-semibold text-gray-800">
                        {{ \Carbon\Carbon::parse($prestamo->fecha_inicio)->format('d/m/Y') }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Fecha Fin Estimado</p>
                    <p class="font-semibold text-gray-800">
                        {{ \Carbon\Carbon::parse($prestamo->fecha_fin_estimado)->format('d/m/Y') }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Frecuencia de Pago</p>
                    <p class="font-semibold text-gray-800">{{ ucfirst($prestamo->rango) }}</p>
                </div>
            </div>

            @if ($prestamo->observaciones)
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600 mb-1">Observaciones</p>
                    <p class="text-gray-800">{{ $prestamo->observaciones }}</p>
                </div>
            @endif
        </div>

        <!-- Tabla de Pagos -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Historial de Cuotas</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg">
                    <thead class="bg-green-600 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Nº Cuota</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Código</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Vencimiento</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Monto Esperado</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Monto Pagado</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Estado</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Fecha Pago</th>
                        </tr>
                    </thead>
                    <tbody id="lista-pagos">
                        @forelse ($prestamo->pagos as $pago)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 text-sm font-medium">{{ $pago->numero_cuota }}</td>
                                <td class="py-3 px-4 text-sm text-gray-600">#{{ $pago->codigo }}</td>
                                <td class="py-3 px-4 text-sm">
                                    {{ \Carbon\Carbon::parse($pago->vencimiento)->format('d/m/Y') }}
                                </td>
                                <td class="py-3 px-4 text-sm font-medium text-blue-700">
                                    Gs. {{ number_format($pago->monto_esperado, 0, ',', '.') }}
                                </td>
                                <td class="py-3 px-4 text-sm font-medium text-green-700">
                                    Gs. {{ number_format($pago->monto_pagado ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="py-3 px-4">
                                    <span @class([
                                        'text-xs px-3 py-1 rounded-full font-semibold',
                                        'bg-green-100 text-green-700' => $pago->estado == 'pagado',
                                        'bg-yellow-100 text-yellow-700' => $pago->estado == 'parcial',
                                        'bg-red-100 text-red-700' => $pago->estado == 'no_pagado',
                                        'bg-gray-100 text-gray-700' => $pago->estado == 'pendiente',
                                    ])>
                                        {{ ucfirst($pago->estado) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    {{ $pago->fecha_pago ? \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-8 text-center text-gray-500">
                                    No hay pagos registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Información del Cliente -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Información del Cliente</h3>
                <a href="{{ route('cliente.show', $prestamo->cliente_id) }}"
                    class="text-green-600 hover:text-green-800 font-semibold transition-all">
                    Ver Perfil Completo →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Nombre</p>
                    <p class="font-semibold text-gray-800">{{ $prestamo->cliente->nombre }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Teléfono</p>
                    <p class="font-semibold text-gray-800">{{ $prestamo->cliente->telefono ?? 'No registrado' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Dirección</p>
                    <p class="font-semibold text-gray-800">{{ $prestamo->cliente->direccion ?? 'No registrada' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">CI</p>
                    <p class="font-semibold text-gray-800">{{ $prestamo->cliente->nro_ci ?? 'No registrado' }}</p>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/detalle-prestamo.js') }}"></script>
@endsection
