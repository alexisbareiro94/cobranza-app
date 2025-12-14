@extends('layouts.app')

@section('title', 'Préstamos')

@section('content')
    <div id="prestamos-container" class="fade-in">
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Historial de Préstamos</h2>
            </div>

            <!-- Filtros -->
            <div class="mb-4 flex flex-wrap gap-3">
                <select id="filtro-estado-prestamo" class="text-sm px-3 py-2 border border-gray-300 rounded-md">
                    <option value="">Todos los estados</option>
                    <option value="activo">Activo</option>
                    <option value="finalizado">Finalizado</option>
                    <option value="cancelado">Cancelado</option>
                </select>

                <select id="filtro-clientes-prestamo" class="text-sm px-3 py-2 border border-gray-300 rounded-md">
                    <option value="">Todos los clientes</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                    @endforeach
                </select>

                <input type="text" id="search-codigo" placeholder="Buscar por código..."
                    class="text-sm px-3 py-2 border border-gray-300 rounded-md w-48">

                <button id="btn-filtrar-prestamos"
                    class="text-sm font-semibold bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700 transition-all">
                    Filtrar
                </button>

                <button id="btn-limpiar-filtros"
                    class="text-sm font-semibold bg-gray-200 text-gray-700 px-3 py-2 rounded hover:bg-gray-300 transition-all">
                    Limpiar
                </button>
            </div>

            <!-- Tabla de Préstamos -->
            <div class="overflow-x-auto bg-gray-50 rounded-lg">
                <table class="min-w-full bg-white rounded-lg">
                    <thead class="bg-green-600 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Código</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Cliente</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Monto Prestado</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Monto Total</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Cuotas</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Saldo Pendiente</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Estado</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Fecha Inicio</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="lista-prestamos">
                        @forelse ($prestamos as $prestamo)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 text-sm font-medium text-gray-700">#{{ $prestamo->codigo }}</td>
                                <td class="py-3 px-4 text-sm">{{ $prestamo->cliente->nombre }}</td>
                                <td class="py-3 px-4 text-sm font-medium text-green-700">
                                    Gs. {{ number_format($prestamo->monto_prestado, 0, ',', '.') }}
                                </td>
                                <td class="py-3 px-4 text-sm font-medium">
                                    Gs. {{ number_format($prestamo->monto_total, 0, ',', '.') }}
                                </td>
                                <td class="py-3 px-4 text-sm">
                                    <span class="font-semibold text-green-600">{{ $prestamo->cuotas_pagadas }}</span>
                                    /
                                    <span class="text-gray-600">{{ $prestamo->cantidad_cuotas }}</span>
                                </td>
                                <td class="py-3 px-4 text-sm font-medium text-orange-600">
                                    Gs. {{ number_format($prestamo->saldo_pendiente, 0, ',', '.') }}
                                </td>
                                <td class="py-3 px-4">
                                    <span @class([
                                        'text-xs px-3 py-1 rounded-full font-semibold',
                                        'bg-green-100 text-green-700' => $prestamo->estado == 'activo',
                                        'bg-blue-100 text-blue-700' => $prestamo->estado == 'finalizado',
                                        'bg-red-100 text-red-700' => $prestamo->estado == 'cancelado',
                                    ])>
                                        {{ ucfirst($prestamo->estado) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($prestamo->fecha_inicio)->format('d/m/Y') }}
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('prestamos.show', $prestamo->id) }}"
                                            class="text-green-600 hover:text-green-800 transition-all"
                                            title="Ver detalle del préstamo">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-300 mb-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                        <p class="text-lg">No hay préstamos registrados</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div id="paginacion-prestamos" class="flex justify-center mt-6">
                {{ $prestamos->links() }}
            </div>
        </div>
    </div>

    <script src="{{ asset('js/prestamos.js') }}"></script>
@endsection
