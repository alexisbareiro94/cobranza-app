@extends('layouts.app')

@section('title', 'Información del Cliente')

@push('styles')
    <link href='https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.css' rel='stylesheet' />
@endpush

@section('content')
    <div class="min-h-screen w-full bg-gray-100 p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Columna izquierda -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Información Personal -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>

                        <h3 class="text-xl font-bold text-gray-800">Información Personal</h3>
                    </div>


                    <i id="btn-edit-info" class="cursor-pointer transition-all active:scale-90">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </i>

                </div>

                <div class="bg-white shadow-md rounded-xl p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4">
                        <form id="form-info">
                            <input type="hidden" id="cliente_id" name="cliente_id" value="{{ $cliente->id }}">
                            <div>
                                <label for="nombre" class="text-sm text-gray-500">Nombre</label>
                                <input type="text" disabled id="nombre" name="nombre" class="text-gray-800 w-full"
                                    value="{{ $cliente->nombre }}">
                            </div>

                            <div>
                                <label for="ci" class="text-sm text-gray-500">Número de CI</label>
                                <input type="text" disabled id="ci" name="ci" class="text-gray-800 w-full"
                                    value="{{ $cliente->nro_ci }}">
                            </div>

                            <div>
                                <label for="correo" class="text-sm text-gray-500">Correo Electrónico</label>
                                <input type="text" disabled id="correo" name="correo" class="text-gray-800 w-full"
                                    value="{{ $cliente->correo }}">
                            </div>

                            <div>
                                <label for="telefono" class="text-sm text-gray-500">Teléfono</label>
                                <input type="text" disabled id="telefono" name="telefono" class="text-gray-800 w-full"
                                    value="{{ $cliente->telefono }}">
                            </div>

                            <div id="div-btns-confirm" class="flex items-center gap-2 justify-end pt-4"></div>
                        </form>
                    </div>

                </div>
                <!-- Información de Contacto -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>

                        <h3 class="text-xl font-bold text-gray-800">
                            Información de Contacto
                        </h3>

                    </div>

                    <button id="btn-edit-contacto" class="cursor-pointer transition-all active:scale-90">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </button>
                </div>
                <div class="bg-white shadow-md rounded-xl p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4">
                        <form id="form-contacto">
                            <input type="hidden" id="cliente_id" name="cliente_id" value="{{ $cliente->id }}">
                            <div>
                                <p class="text-sm text-gray-500">Dirección</p>
                                <input type="text" disabled id="direccion" name="direccion" class="text-gray-800 w-full"
                                    value="{{ $cliente->direccion }}">
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Ciudad</p>
                                <p id="ciudad-text">{{ set_ciudad($cliente->ciudad) }}</p>
                                <div id="ciudades" class="hidden">
                                    @include('include.ciudades', ['ciudadId' => $cliente->ciudad])
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Referencia</p>
                                <input type="text" disabled id="referencia" name="referencia"
                                    class="text-gray-800 w-full" value="{{ $cliente->referencia ?? 'N/A' }}">
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Ubicación</p>
                                <div class="flex justify-between gap-2">
                                    <input type="text" disabled id="geo" name="geo"
                                        class="text-gray-800 w-full" value="{{ $cliente->geo }}">

                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $cliente->geo }}"
                                        target="_blank" id="btn-open-maps"
                                        class="hidden cursor-pointer transition-all active:scale-90 flex items-center gap-2">
                                        <span class="text-xs text-gray-500">Google Maps</span>
                                    </a>
                                </div>
                            </div>

                            <div id="div-btns-contacto" class="flex items-center gap-2 justify-end pt-4"></div>
                        </form>
                    </div>
                </div>

                <!-- Mapa de Ubicación -->
                <h3 class="text-xl font-bold text-gray-800 mb-4">🗺️ Ubicación en el Mapa</h3>
                <div class="bg-white shadow-md rounded-xl p-5">
                    <div id="map" class="w-full h-64 rounded-lg" style="min-height: 300px;"></div>
                </div>
            </div>

            <!-- Columna derecha -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Resumen -->
                <div class="bg-white shadow-md rounded-xl p-5">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">💰 Resumen de Préstamos</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-blue-50 p-3 rounded-lg">
                            <p class="text-sm text-blue-600">Total Préstamos</p>
                            <p class="text-lg font-bold text-blue-800">{{ $cliente->prestamos->count() }}</p>
                        </div>
                        <div class="bg-green-50 p-3 rounded-lg">
                            <p class="text-sm text-green-600">Activos</p>
                            <p class="text-lg font-bold text-green-800">
                                {{ $cliente->prestamos->where('estado', 'activo')->count() }}</p>
                        </div>
                        <div class="bg-yellow-50 p-3 rounded-lg">
                            <p class="text-sm text-yellow-600">Pendientes</p>
                            <p class="text-lg font-bold text-yellow-800">
                                {{ $cliente->prestamos->where('estado', 'activo')->count() }}</p>
                        </div>
                        <div class="bg-red-50 p-3 rounded-lg">
                            <p class="text-sm text-red-600">Finalizados</p>
                            <p class="text-lg font-bold text-red-800">
                                {{ $cliente->prestamos->where('estado', 'completado')->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Préstamos Activos -->
                <div class="bg-white shadow-md rounded-xl p-5">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">📊 Préstamos</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Código</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Pagos en
                                    </th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Monto</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Cuotas</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Saldo</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    @foreach ($cliente->prestamos as $prestamo)
                                        <td class="px-4 py-2 text-sm text-gray-500">{{ $prestamo->codigo }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-900">{{ $prestamo->rango }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-900">
                                            Gs. {{ format_monto($prestamo->monto_total ?? 1) }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-900">{{ $prestamo->cuotas_pagadas }} /
                                            {{ $prestamo->cantidad_cuotas }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-900">Gs.
                                            {{ format_monto($prestamo->saldo_pendiente ?? 1) }}</td>
                                        <td class="px-4 py-2">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs bg-green-100 text-green-800">Activo</span>
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Próximos Pagos -->
                <div class="bg-white shadow-md rounded-xl p-5">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">📅 Próximo Pago</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Préstamo
                                    </th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Cuota</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Monto</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Vencimiento
                                    </th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-500">
                                        {{ $cliente->pagos->where('estado', 'pendiente')->first()->codigo ?? 'No hay pagos pendientes' }}
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-900">
                                        {{ $cliente->pagos->where('estado', 'pendiente')->first()->numero_cuota ?? 'No hay pagos pendientes' }}
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-900">
                                        Gs.
                                        {{ format_monto($cliente->pagos->where('estado', 'pendiente')->first()->monto_esperado ?? 0) }}
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-900">
                                        {{ $cliente->pagos->where('estado', 'pendiente')->first()->vencimiento ?? 'No hay pagos pendientes' }}
                                    </td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs bg-yellow-100 text-yellow-800">Pendiente</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        @vite('resources/js/ver-cliente.js')
    @endpush
@endsection
