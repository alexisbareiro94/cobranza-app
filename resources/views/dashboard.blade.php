@extends('layouts.app')

@section('title', 'Menu')

@section('content')
    <div class="bg-gray-50 min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar (solo visible en desktop) -->
        <aside class="hidden md:flex flex-col w-64 bg-gradient-to-b from-gray-100 to-gray-200 text-green-500 p-6 space-y-6">
            <div>
                <h1 class="text-xl font-bold">Panel del cobrador</h1>
            </div>
            <nav class="flex flex-col space-y-3">
                <a href="#" class="flex items-center space-x-2 hover:bg-green-700 p-2 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path
                            d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                        <path
                            d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                    </svg>
                    <span>Inicio</span>
                </a>
                <a href="#" class="flex items-center space-x-2 hover:bg-green-700 p-2 rounded">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3M3.22302 14C4.13247 18.008 7.71683 21 12 21c4.9706 0 9-4.0294 9-9 0-4.97056-4.0294-9-9-9-3.72916 0-6.92858 2.26806-8.29409 5.5M7 9H3V5" />
                    </svg>
                    <span>Historial</span>
                </a>
                <a href="#" class="flex items-center space-x-2 hover:bg-green-700 p-2 rounded">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v15a1 1 0 0 0 1 1h15M8 16l2.5-5.5 3 3L17.273 7 20 9.667" />
                    </svg>
                    <span>Reportes</span>
                </a>
                <a href="#" class="flex items-center space-x-2 hover:bg-green-700 p-2 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span>Ajustes</span>
                </a>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <main class="flex-1 pb-16 md:pb-0">
            <!-- Header -->
            <div
                class="flex justify-between bg-gradient-to-r shadow-sm from-gray-100 to-gray-200 text-green-700 p-4 md:flex md:justify-between md:items-center">
                <div>
                    <h1 class="text-lg font-bold">¡Buenos días, {{ auth()->user()->name }}!</h1>
                    <p class="text-green-500 text-sm">Hoy: {{ now()->format('d-m-Y') }}</p>
                </div>
                <button class="text-white bg-green-400 bg-opacity-20 px-3 py-3 rounded-full mt-2 md:mt-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>

                </button>
            </div>

            <!-- Contenedor general -->
            <div class="p-4 space-y-6 md:space-y-0 md:grid md:grid-cols-3 md:gap-6">
                <!-- Resumen rápido -->
                <div class="col-span-1 space-y-3">
                    <div class="bg-gray-100 rounded-lg shadow-sm p-3 text-center">
                        <p class="text-xs text-gray-500">Cobros hoy</p>
                        <p class="text-xl font-bold text-green-700">S/ 420</p>
                        <p class="text-xs text-gray-400">de S/ 800</p>
                    </div>
                    <div class="bg-gray-100 rounded-lg shadow p-3 text-center">
                        <p class="text-xs text-gray-500">Clientes</p>
                        <p class="text-xl font-bold text-gray-800">8/12</p>
                        <p class="text-xs text-gray-400">completados</p>
                    </div>

                    <!-- Acciones rápidas -->
                    <div class="mt-4">
                        <h2 class="font-semibold text-gray-800 mb-2">Acciones</h2>
                        <div class="flex space-x-3">
                            <button
                                class="flex-1 bg-gray-100 py-3 rounded-lg shadow text-center flex flex-col items-center justify-center hover:bg-gray-50">
                                <span class="text-green-600 text-xl mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                                    </svg>

                                </span>
                                <span class="text-xs">Ver ruta</span>
                            </button>
                            <button id="btn-open-modal-add-cliente"
                                class="cursor-pointer flex-1 bg-gray-100 py-3 rounded-lg shadow text-center flex flex-col items-center justify-center transition-all active:scale-90 hover:bg-gray-50">
                                <span class="text-green-600 text-xl mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                    </svg>


                                </span>
                                <span class="text-xs">Nuevo Cliente</span>
                            </button>
                            <button id="btn-open-nuevo-cargo"
                                class="cursor-pointer flex-1 bg-gray-100 py-3 rounded-lg shadow text-center flex flex-col items-center justify-center transition-all active:scale-90 hover:bg-gray-50">
                                <span class=" text-green-600 text-xl mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </span>
                                <span class="text-xs">Nuevo Cargo</span>
                            </button>
                        </div>
                    </div>

                    <div class="xl2:hidden mt-6 font-semibold flex items-center justify-center">
                        <button class="bg-gray-200 text-sm text-center px-4 py-2 rounded-md">
                            Ver Clientes
                        </button>
                    </div>

                    <div class="hidden xl2:block mt-4 font-semibold">
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
                        <span
                            class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">{{ $cantidad }}</span>
                    </div>
                    @foreach ($prestamos as $prestamo)
                        <x-prestamos :$prestamo />
                    @endforeach

                    <div class="flex justify-center mt-12">
                        <button class="bg-gray-200 text-gray-600 font-semibold px-3 py-1 rounded-md cursor-pointer hover:bg-gray-300 transition-all active:scale-90">
                            Ver próximos
                        </button>
                    </div>
                </div>
            </div>

            <!-- Barra inferior solo en móvil -->
            <nav
                class="md:hidden fixed bottom-0 left-0 right-0 min-h-[70px]  bg-gray-100 border-t border-gray-200 flex justify-around py-2">
                <a href="#" class="text-green-600 flex flex-col items-center text-md pt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path
                            d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                        <path
                            d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                    </svg>

                    <span>Inicio</span>
                </a>
                <a href="#" class="text-gray-500 flex flex-col items-center text-md pt-2">
                    <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3M3.22302 14C4.13247 18.008 7.71683 21 12 21c4.9706 0 9-4.0294 9-9 0-4.97056-4.0294-9-9-9-3.72916 0-6.92858 2.26806-8.29409 5.5M7 9H3V5" />
                    </svg>

                    <span>Historial</span>
                </a>
                <a href="#" class="text-gray-500 flex flex-col items-center text-md pt-2">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v15a1 1 0 0 0 1 1h15M8 16l2.5-5.5 3 3L17.273 7 20 9.667" />
                    </svg>

                    <span>Reportes</span>
                </a>
                <a href="#" class="text-gray-500 flex flex-col items-center text-md pt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    <span>Ajustes</span>
                </a>
            </nav>
        </main>
        @include('include.add-cliente')
        @include('include.add-prestamo')
    </div>
@endsection
