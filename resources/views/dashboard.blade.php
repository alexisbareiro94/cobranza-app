@extends('layouts.app')

@section('title', 'Menu')

@section('content')
    <!-- Contenedor general -->
    <div class="p-4 space-y-6 md:space-y-0 md:grid md:grid-cols-3 md:gap-6">
        <!-- Resumen rápido -->
        <div class="col-span-1 space-y-3">
            <x-ganancia-diaria />

            <!-- Acciones rápidas -->
            <div class="mt-4">
                <h2 class="font-semibold text-gray-800 mb-2">Acciones</h2>
                <div class="flex space-x-3">
                    <a href="{{ route('ruta.index') }}"
                        class="flex-1 bg-gray-100 py-3 rounded-lg shadow text-center flex flex-col items-center justify-center transition-all active:scale-90 hover:bg-gray-50">
                        <span class="text-green-600 text-xl mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                            </svg>

                        </span>
                        <span class="text-xs">Ver ruta</span>
                    </a>
                    <button id="btn-open-modal-add-cliente"
                        class="cursor-pointer flex-1 bg-gray-100 py-3 rounded-lg shadow text-center flex flex-col items-center justify-center transition-all active:scale-90 hover:bg-gray-50">
                        <span class="text-green-600 text-xl mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                            </svg>


                        </span>
                        <span class="text-xs">Nuevo Cliente</span>
                    </button>
                    <button id="btn-open-nuevo-cargo"
                        class="cursor-pointer flex-1 bg-gray-100 py-3 rounded-lg shadow text-center flex flex-col items-center justify-center transition-all active:scale-90 hover:bg-gray-50">
                        <span class=" text-green-600 text-xl mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </span>
                        <span class="text-xs">Nuevo Prestamo</span>
                    </button>
                </div>
            </div>

            <div class="xl2:hidden mt-6 font-semibold flex items-center justify-center">
                <button id="abrir-todos-clientes"
                    class="bg-gray-200 text-sm text-center px-4 py-2 rounded-md transition active:scale-90">
                    Ver Clientes
                </button>


                <x-todos-clientes :$clientes />
            </div>
            @include('include.ver-clientes')

            <div id="clientes-container" class="hidden xl2:block mt-4 font-semibold">
                <h2>Clientes</h2>
                @foreach ($clientes as $cliente)
                    <x-clientes :$cliente />
                @endforeach
            </div>
        </div>

        <!-- Lista de prestamos -->
        <div class="col-span-2">
            <div class="flex justify-between items-center mb-3">
                <h2 class="font-semibold text-gray-800">Pendiente a pago y vencidos</h2>
                <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">{{ $cantidad }}</span>
            </div>
            <div id="prestamos-container">
                @foreach ($prestamos as $prestamo)
                    <x-prestamos :$prestamo />
                    {{-- prestamos-component.js --}}
                @endforeach
            </div>
            @include('include.gestion-pago')

            <div class="flex justify-center mt-12">
                <button id="abrir-proximos-pagos"
                    class="bg-gray-200 text-gray-600 font-semibold px-3 py-1 rounded-md cursor-pointer hover:bg-gray-300 transition-all active:scale-90">
                    Ver próximos
                </button>
            </div>

            <x-proximos-pagos />
        </div>
    </div>
@endsection
