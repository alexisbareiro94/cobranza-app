{{-- prestamos-component.js --}}
<div id="modal-gestion-pago"
    class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black/10  transition-all duration-200">
    <div id="modal-in-out" class="relative w-full max-w-md max-h-[90vh] p-4 animate-modal-in ">
        <!-- Modal content -->
        <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col">
            <!-- Header -->
            <div class="bg-white text-green-700 border-b border-green-700 p-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">
                    Gestionar Pago
                    <p id="pago-codigo" class="font-normal text-xs -mt-1">código:</p>
                </h3>
                <button id="cerrar-modal-gestion-pago"
                    class="hover:bg-green-800/40 focus:ring-2 focus:ring-white rounded-full w-8 h-8 flex items-center justify-center transition">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <div class="p-5 overflow-y-auto max-h-[65vh] flex-grow space-y-6">
                <!-- Cuota -->
                <div class="border border-gray-200 rounded-xl p-5 bg-white shadow-sm">
                    <div class="flex justify-between items-start mb-3">
                        <h4 id="nro-cuota-pago" class="font-semibold text-gray-800">Cuota nro: <span
                                class="font-normal">1</span></h4>
                        <p class="text-sm text-gray-500">Vence:
                            <span id="vence-pago" class="font-medium text-green-700">16-10-2025</span>
                        </p>
                    </div>

                    <div class="space-y-1.5 mb-3">
                        <p class="text-gray-800 flex justify-between">
                            Total a pagar: <span id="total-prestamo-pago" class="font-semibold text-green-700">
                                Gs. 600.000</span>
                        </p>
                        <p class="text-gray-800 flex justify-between">
                            Total restante: <span id="prestamo-restante-pago" class="font-semibold text-green-700">
                                Gs. 550.000</span>
                        </p>
                        <p class="text-gray-800 flex justify-between">
                            Monto por cuota: <span id="monto-cuota" class="font-semibold text-green-700">
                                Gs. 100.000</span>
                        </p>
                    </div>

                    <div id="pago-parcial" class="hidden bg-orange-100  rounded-lg p-3 mt-2">
                        <p class="text-orange-400 text-sm">
                            Se realizó un pago parcial de: <span id="monto-parcial" class="font-medium text-orange-500">Gs. 50.000</span>.
                        </p>
                        <p id="fecha-pago" class="text-gray-500 text-xs mt-1">16-10-25 / 08:45</p>
                    </div>
                </div>
                <!-- Cliente -->
                <div class="text-sm">
                    <p class="text-gray-700 font-semibold">Cliente:</p>
                    <p id="cliente-pago" class="text-gray-800">Alexis Bareiro</p>
                </div>

                <!-- Formulario -->
                <form id="form-gestion-pago" class="space-y-5">
                    <!-- Monto -->
                    <div>
                        <label for="monto-pago-pago" class="block text-sm font-semibold text-gray-700 mb-1">Monto del
                            pago
                        </label>
                        <input id="monto-pago-pago" name="monto-pago-pago" type="number" value="600000" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition" />
                    </div>

                    <!-- Estado -->
                    <div>
                        <label for="estado-pago" class="block text-sm font-semibold text-gray-700 mb-1">Estado del
                            pago</label>
                        <select id="estado-pago" name="estado"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                            <option selected value="pagado">Pagado</option>
                            <option value="parcial">Pago parcial</option>
                            <option value="no_pagado">No pagado</option>
                        </select>
                    </div>

                    <!-- Observaciones -->
                    <div>
                        <label for="observaciones-pago"
                            class="block text-sm font-semibold text-gray-700 mb-1">Observaciones</label>
                        <textarea id="observaciones-pago" name="observaciones-pago" rows="3"
                            placeholder="Ej: Pago recibido en efectivo..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"></textarea>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-3 justify-end pt-2">
                        <button type="button" id="btn-cancelar"
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 transition">
                            Cancelar
                        </button>
                        <button type="submit" id="btn-aceptar-pago"
                            class="px-4 py-2 text-white bg-green-700 rounded-lg shadow hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 transition">
                            Aceptar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
