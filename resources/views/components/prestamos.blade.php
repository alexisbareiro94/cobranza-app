<div class="space-y-3 mb-3">
    <div class="bg-gray-100 rounded-lg shadow p-3 hover:shadow-md transition">
        <div class="flex justify-between items-start">
            <div>
                <div class="flex">
                    <h3 class="font-medium">{{ ucfirst($prestamo->cliente->nombre) }}</h3>
                    <select class="ml-3 text-sm px-2 py-1 border border-gray-300 rounded-md" name="prestamos"
                        id="prestamos">
                        <option value="" selected disabled>Ver Pagos</option>
                        @foreach ($prestamo->pagos as $pago)
                            <option value="" disabled>{{ format_fecha($pago->vencimiento) }} ●
                                <span>{{ set_estado_pago($pago->estado) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <p class="text-sm text-gray-600">{{ $prestamo->cliente->direccion }},
                    {{ set_ciudad($prestamo->cliente->ciudad) }}</p>
                <p class="text-sm font-bold text-gray-600 mt-1">
                    {{-- monto --}}
                    Gs.
                    {{ format_monto($prestamo->proximo_pago->monto_esperado - $prestamo->proximo_pago->monto_pagado) }}
                    |
                    {{-- vence/vencio --}}
                    {{ verificar_fecha($prestamo->proximo_pago->vencimiento) }}
                    {{-- fecha/hoy --}}
                    {{ format_fecha($prestamo->proximo_pago->vencimiento, true) }}
                </p>
            </div>
            <div class="flex flex-col space-y-2">
                <a href="tel:+595{{ $prestamo->cliente->telefono }}" class="text-green-600 hover:text-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                {{-- //whasap --}}
                <a href="https://wa.me/595{{ $prestamo->cliente->telefono }}" target="_blank"
                    class="text-green-600 hover:text-green-800 pt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="" viewBox="0 0 16 16">
                        <path
                            d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="mt-3 flex justify-between items-center relative">
            <span id="prueba" @class([
                'text-xs px-2 py-1 rounded font-semibold',
                'bg-yellow-200 text-yellow-700' =>
                    $prestamo->proximo_pago->estado == 'pendiente',
                'bg-orange-200 text-orange-700' =>
                    $prestamo->proximo_pago->estado == 'parcial',
                'bg-red-200 text-red-700' => $prestamo->proximo_pago->estado == 'no_pagado',
                'bg-green-200 text-green-700' =>
                    $prestamo->proximo_pago->estado == 'pagado',
            ])>
                {{ set_estado_pago($prestamo->proximo_pago->estado) }}
            </span>
            <div class="flex gap-6">
                <button
                    class="gestionar-pago text-sm font-semibold bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 cursor-pointer transition-all active:scale-90"
                    data-id="{{ $prestamo->proximo_pago->id }}" id="gestionar-pago">
                    Gestionar pago
                </button>
                <a class="text-blue-600 hover:text-blue-800"
                    href="https://www.google.com/maps/search/?api=1&query={{ $prestamo->cliente->geo }}"
                    target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            <span class="text-gray-500 text-[10px] absolute -bottom-3.5">Código:
                #{{ $prestamo->proximo_pago->codigo }}</span>
        </div>
    </div>
</div>
