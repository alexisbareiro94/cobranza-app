<!-- Main modal -->
{{-- componente de proximos pagos --}}
<div id="modal-proximos-pagos"
    class="hidden fixed inset-0 z-30 flex justify-center items-center w-full h-full bg-black/20">
    <div id="proximos-pagos-animation" class="relative p-4 w-full md:max-w-6xl max-h-full animate-modal-in">
        <!-- Modal content -->
        <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Modal header -->
            <div class="bg-white p-4 text-green-700 border-b border-green-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold">
                        <i class="fas fa-user-plus mr-2"></i>Próximos Pagos
                    </h3>
                    <button id="cerrar-proximos-pagos"
                        class="text-green-700 hover:bg-black/20 hover:text-white rounded-full w-8 h-8 flex items-center justify-center transition">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Cerrar</span>
                    </button>
                </div>
            </div>

            <div class="p-4 md:p-5">
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 md:p-5 transition-shadow duration-200 hover:shadow-md">
                    <div class="flex flex-col sm:flex-row gap-3 md:gap-4">
                        <!-- Búsqueda por cliente o dirección -->
                        <div class="flex-grow">
                            <label for="search-proximos-pagos" class="sr-only">Buscar por cliente o dirección</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" id="search-proximos-pagos"
                                    placeholder="Buscar por cliente o dirección..."
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" />
                            </div>
                        </div>

                        <!-- Fecha de inicio -->
                        <div>
                            <label for="desde" class="sr-only">Fecha de inicio</label>
                            <input type="date" id="desde"
                                class="w-full py-2.5 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" />
                        </div>

                        <!-- Fecha de fin -->
                        <div>
                            <label for="hasta" class="sr-only">Fecha de fin</label>
                            <input type="date" id="hasta"
                                class="w-full py-2.5 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" />
                        </div>
                        <button id="buscar-proximos-pagos"
                            class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg transition">
                            Buscar
                        </button>
                    </div>
                </div>
            </div>
            <!-- Modal body -->
            <div id="proximos-pagos-body" class="p-4 md:p-5 max-h-[60vh] md:max-h-[70vh] overflow-y-auto">
                @foreach ($prestamos as $prestamo)
                    <div class="bg-gray-100 rounded-lg shadow p-3 mb-4 hover:shadow-md">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="flex">
                                    <h3 class="font-medium">{{ ucfirst($prestamo->cliente->nombre) }}</h3>
                                </div>
                                <p class="text-sm text-gray-600">{{ $prestamo->cliente->direccion }},
                                    {{ set_ciudad($prestamo->cliente->ciudad) }}</p>
                                <p class="text-sm font-bold text-gray-600 mt-1">
                                    Gs. {{ format_monto($prestamo->prestamo->monto_cuota) }} |
                                    vence: {{ format_fecha($prestamo->vencimiento, false) }}
                                </p>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <a href="tel:+595{{ $prestamo->cliente->telefono }}"
                                    class="text-green-600 hover:text-green-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-5">
                                        <path fill-rule="evenodd"
                                            d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="https://wa.me/595{{ $prestamo->cliente->telefono }}" target="_blank"
                                    class="text-green-600 hover:text-green-800 pt-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" class="" viewBox="0 0 16 16">
                                        <path
                                            d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="mt-3 flex justify-between items-center relative">
                            <span id="prueba" @class([
                                'text-xs px-2 py-1 rounded font-semibold',
                                'bg-yellow-200 text-yellow-700' => $prestamo->estado == 'pendiente',
                                'bg-orange-300 text-orange-700' => $prestamo->estado == 'parcial',
                                'bg-red-200 text-red-700' => $prestamo->estado == 'no_pagado',
                                'bg-green-200 text-green-700' => $prestamo->estado == 'pagado',
                            ])>
                                {{ set_estado_pago($prestamo->estado) }}
                            </span>
                            <div class="flex gap-6">
                                <button
                                    class="gestionar-pago text-sm font-semibold bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 cursor-pointer transition-all active:scale-90"
                                    data-id="{{ $prestamo->id }}" id="gestionar-pago">
                                    Gestionar pago
                                </button>
                                <a class="text-blue-600 hover:text-blue-800"
                                    href="https://www.google.com/maps/search/?api=1&query={{ $prestamo->cliente->geo }}"
                                    target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6">
                                        <path fill-rule="evenodd"
                                            d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                            <span class="text-gray-500 text-[10px] absolute -bottom-3.5">Código:
                                #{{ $prestamo->codigo }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
