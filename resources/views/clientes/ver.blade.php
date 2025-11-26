@extends('layouts.app')

@section('title', 'Información del Cliente')

@section('content')
    <div class="min-h-screen w-full bg-gray-100 p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Columna izquierda -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Información Personal -->
                <div class="bg-white shadow-md rounded-xl p-5">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">👤 Información del Cliente</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Nombre</p>
                            <p class="text-gray-800">{{ $cliente->nombre }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Número de CI</p>
                            <p class="text-gray-800">{{ $cliente->ci }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Correo Electrónico</p>
                            <p class="text-gray-800">{{ $cliente->correo }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Teléfono</p>
                            <p class="text-gray-800">{{ $cliente->telefono }}</p>
                        </div>
                    </div>
                </div>

                <!-- Información de Contacto -->
                <div class="bg-white shadow-md rounded-xl p-5">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">📍 Información de Contacto</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Dirección</p>
                            <p class="text-gray-800">{{ $cliente->direccion }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Ciudad</p>
                            <p class="text-gray-800">{{ set_ciudad($cliente->ciudad) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Referencia</p>
                            <p class="text-gray-800">{{ $cliente->referencia ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Ubicación</p>
                            <p class="text-gray-800">{{ $cliente->geo }}</p>
                        </div>
                    </div>
                </div>

                {{-- <!-- Información del Cobrador -->
                <div class="bg-white shadow-md rounded-xl p-5">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">👨‍💼 Cobrador Asignado</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Cobrador</p>
                            <p class="text-gray-800">Carlos González</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Estado</p>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                ✅ Activo
                            </span>
                        </div>
                    </div>
                </div> --}}
            </div>

            <!-- Columna derecha -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Resumen -->
                <div class="bg-white shadow-md rounded-xl p-5">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">💰 Resumen de Préstamos</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-blue-50 p-3 rounded-lg">
                            <p class="text-sm text-blue-600">Total Préstamos</p>
                            <p class="text-lg font-bold text-blue-800">3</p>
                        </div>
                        <div class="bg-green-50 p-3 rounded-lg">
                            <p class="text-sm text-green-600">Activos</p>
                            <p class="text-lg font-bold text-green-800">2</p>
                        </div>
                        <div class="bg-yellow-50 p-3 rounded-lg">
                            <p class="text-sm text-yellow-600">Pendientes</p>
                            <p class="text-lg font-bold text-yellow-800">1</p>
                        </div>
                        <div class="bg-red-50 p-3 rounded-lg">
                            <p class="text-sm text-red-600">Finalizados</p>
                            <p class="text-lg font-bold text-red-800">1</p>
                        </div>
                    </div>
                </div>

                <!-- Préstamos Activos -->
                <div class="bg-white shadow-md rounded-xl p-5">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">📊 Préstamos Activos</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Código</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Monto</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Cuotas</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Saldo</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-500">PR-001</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">1.500.000 ₲</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">5/12</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">875.000 ₲</td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs bg-green-100 text-green-800">Activo</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Próximos Pagos -->
                <div class="bg-white shadow-md rounded-xl p-5">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">📅 Próximos Pagos</h3>

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
                                    <td class="px-4 py-2 text-sm text-gray-500">PR-001</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">6</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">125.000 ₲</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">15/10/2023</td>
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
