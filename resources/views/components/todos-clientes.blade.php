<!-- Main modal -->
<div id="modal-todos-clientes"
    class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black/40">
    <div id="clientes-animate" class="relative p-4 w-full max-w-md max-h-full animate-modal-in">
        <!-- Modal content -->
        <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Modal header -->
            <div class="bg-white p-4 text-green-700 border-b border-green-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold">
                        <i class="fas fa-user-plus mr-2"></i>Todos los clientes
                    </h3>
                    <button id="cerrar-todos-clientes"
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

            <!-- Modal body -->
            <div class=" max-h-[80vh] overflow-y-auto">
                @foreach ($clientes as $cliente)
                                
                <div data-id="{{ $cliente->id }}"
                    class="clientes flex items-center bg-gray-100 rounded-2xl shadow-md mb-2 p-2 hover:shadow-lg transition cursor-pointer">
                    {{-- Imagen del cliente --}}
                    <div class="w-22 h-24 rounded-xl overflow-hidden flex-shrink-0 bg-white">
                        @if ($cliente->imagen)
                            {{-- <img src="{{ asset('storage/' . $cliente->imagen) }}" alt="{{ $cliente->nombre }}" class="w-full h-full object-cover"> --}}
                        @else
                            <div class="flex items-center justify-center w-full h-full text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 11c2.21 0 4-1.79 4-4S14.21 3 12 3 8 4.79 8 7s1.79 4 4 4zM6 21v-2a4 4 0 014-4h0a4 4 0 014 4v2m6 0v-2a4 4 0 00-4-4h0a4 4 0 00-4 4v2" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Información del cliente --}}
                    <div class="flex-1 items-center ml-4">
                        <div class="flex gap-2 items-start">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $cliente->nombre }}</h3>
                            @if ($cliente->activo)
                                <span
                                    class="px-2 py-1 mt-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Activo</span>
                                {{-- @else
                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-700 rounded-full">Inactivo</span> --}}
                            @endif
                        </div>

                        <p class="text-sm text-gray-600 mt-1">{{ $cliente->direccion ?? 'Sin dirección' }}</p>

                        @if ($cliente->telefono)
                            <p class="text-sm text-gray-500 mt-1">
                                📞 {{ $cliente->telefono }}
                            </p>
                        @endif

                        @if ($cliente->correo)
                            <p class="text-sm text-gray-500">📧 {{ $cliente->correo }}</p>
                        @endif
                    </div>

                    {{-- Acciones --}}
                    <div class="ml-4 flex flex-col gap-2">
                        <a href="#"
                            class="px-3 py-1 bg-emerald-500 text-white text-sm rounded-lg hover:bg-emerald-600">Ver</a>
                        <a href="#"
                            class="px-3 py-1 bg-blue-500 text-white text-sm rounded-lg hover:bg-blue-600">Editar</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
