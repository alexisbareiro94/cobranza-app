<!-- Modal Editar Pago -->
<div id="modal-editar-pago"
    class=" hidden fixed inset-0 z-50 flex justify-center items-center bg-black/10 transition-all duration-200">
    <div id="pagos-animate" class="relative w-full max-w-md max-h-[90vh] p-4 animate-modal-in">
        <!-- Modal content -->
        <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col">
            <!-- Header -->
            <div class="bg-white text-blue-700 border-b border-blue-700 p-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">
                    Editar Pago
                    <p id="editar-pago-codigo" class="font-normal text-xs -mt-1">#PAGO-008</p>
                </h3>
                <button id="cerrar-modal-editar-pago"
                    class="cerrar-editar-pago hover:bg-blue-800/40 focus:ring-2 focus:ring-white rounded-full w-8 h-8 flex items-center justify-center transition">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <div class="p-5 overflow-y-auto max-h-[65vh] flex-grow space-y-6">
                <!-- Información del Pago -->
                <div class="border border-gray-200 rounded-xl p-5 bg-white shadow-sm">
                    <div class="flex justify-between items-start mb-3">
                        <h4 id="" class="font-semibold text-gray-800">Cuota nro:
                            <span id="editar-pago-cuota" class="font-normal">8</span>
                        </h4>
                        <p class="text-sm text-gray-500">Vencía:
                            <span id="editar-pago-vencimiento" class="font-medium text-blue-700">15-08-2023</span>
                        </p>
                    </div>

                    <div class="space-y-1.5 mb-3">
                        <p class="text-gray-800 flex justify-between">
                            Monto Esperado: <span id="editar-pago-monto-esperado"
                                class="font-semibold text-blue-700">Gs. 350.000</span>
                        </p>
                        <p class="text-gray-800 flex justify-between">
                            Pagado: <span id="editar-pago-monto-pagado" class="font-semibold text-green-600">Gs.
                                350.000</span>
                        </p>
                        <p class="text-gray-800 flex justify-between">
                            Fecha de pago: <span id="editar-pago-fecha-pago"
                                class="font-medium text-gray-600">16-08-2023</span>
                        </p>
                    </div>

                    <div class="bg-green-100 rounded-lg p-3 mt-2">
                        <p id="editar-pago-estado" class="text-center text-green-700 text-sm font-medium"></p>
                    </div>

                    <div id="alerta-posible-error"
                        class="hidden bg-yellow-100 rounded-lg p-3 mt-2 flex flex-col items-center justify-center">
                        <i class="text-yellow-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                        </i>
                        <p class="text-center text-yellow-700 text-sm font-medium">
                            Es posible que el monto total pagado no sea el correcto
                        </p>
                    </div>
                </div>

                <!-- Cliente -->
                <div class="text-sm">
                    <p class="text-gray-700 font-semibold">Cliente:</p>
                    <p id="editar-pago-cliente" class="text-gray-800">Juan Pérez</p>
                    <p class="text-gray-600 text-xs mt-1">codigo del Prestamo #
                        <span id="editar-pago-prestamo"></span>
                    </p>
                </div>

                <!-- Formulario de Edición -->
                <form id="form-editar-pago" class="space-y-5">
                    <!-- Fecha de Pago -->
                    <input type="hidden" name="id" id="historial-id" value="">
                    <div>
                        <label for="fecha-pago-edit" class="block text-sm font-semibold text-gray-700 mb-1">
                            Fecha de pago
                        </label>
                        <input id="fecha-pago-edit" name="fecha_pago" type="date" value="2023-08-16"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                    </div>

                    <!-- Monto Pagado -->
                    <div>
                        <label for="monto-pagado-edit" class="block text-sm font-semibold text-gray-700 mb-1">
                            Monto pagado
                        </label>
                        <input id="monto-pagado-edit" name="monto" type="number" value="350000" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                    </div>

                    <!-- Estado -->
                    <div>
                        <label for="estado-pago-edit" class="block text-sm font-semibold text-gray-700 mb-1">
                            Estado del pago
                        </label>
                        <select id="estado-pago-edit" name="estado"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            <option value="">Seleccionar</option>
                            <option value="pagado">Pagado</option>
                            <option value="parcial">Pago parcial</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="no_pagado">No pagado</option>
                        </select>
                    </div>

                    <!-- Observaciones -->
                    <div>
                        <label for="observaciones-pago-edit" class="block text-sm font-semibold text-gray-700 mb-1">
                            Observaciones
                        </label>
                        <textarea id="observaciones-pago-edit" name="observaciones" rows="3" placeholder=""
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"></textarea>
                    </div>

                    <!-- Información de Auditoría -->
                    <div class="border-t border-gray-200 pt-4 mt-4">
                        <p class="text-xs text-gray-500">
                            <span class="font-medium">Creado:</span> 16-08-2023 14:30 por <span
                                class="font-medium">Admin</span>
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            <span class="font-medium">Última modificación:</span> 16-08-2023 14:30 por <span
                                class="font-medium">Admin</span>
                        </p>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-3 justify-end pt-2">
                        <button type="button" id="btn-cancelar-editar"
                            class="cerrar-editar-pago px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 transition">
                            Cancelar
                        </button>
                        <button type="submit" id="btn-guardar-cambios"
                            class="px-4 py-2 text-white bg-blue-700 rounded-lg shadow hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 transition">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
