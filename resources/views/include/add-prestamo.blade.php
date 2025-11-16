<!-- Modal: Agregar Contrato de Cobranza -->
<div id="modal-add-cargo" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black/10">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <!-- Header -->
            <div class="bg-white border-b border-green-700 p-4 text-green-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold">
                        <i class="fas fa-file-invoice-dollar mr-2"></i>
                        Nuevo Contrato
                    </h3>

                    <button id="cerrar-modal-add-contrato"
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

            <!-- Body -->
            <div class="p-4 md:p-5 max-h-[70vh] overflow-y-auto">
                <form id="add-contrato-form" class="space-y-4">
                    <div>
                        <label for="cliente_id" class="block mb-1 text-sm font-medium text-gray-800">
                            Seleccionar Cliente
                        </label>
                        <input type="hidden" value="" id="cliente_id" name="cliente_id" required>
                        <div class="flex items-center gap-4">
                            <button type="button" id="btn-buscar-cliente"
                                class="cursor-pointer transition-all active:scale-90 bg-green-700 px-2 py-1 rounded-md text-white font-semibold">
                                Seleccionar Cliente
                            </button>
                            <span id="cliente-seleccionado-cont"
                                class="hidden border border-gray-300 rounded-md px-2 py-1 font-semibold flex items-center">
                            </span>
                        </div>
                    </div>

                    <!-- Monto total -->
                    <div>
                        <label for="monto_total" class="block mb-1 text-sm font-medium text-gray-800">
                            Monto total
                        </label>
                        <input type="number" step="0.01" id="monto_total" name="monto_total"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50"
                            placeholder="Ej. 1200.50" required>
                    </div>

                    <!-- Monto por cuota -->
                    <div>
                        <label for="monto_cuota" class="block mb-1 text-sm font-medium text-gray-800">
                            Monto por cuota
                        </label>
                        <input type="number" step="0.01" id="monto_cuota" name="monto_cuota"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50"
                            placeholder="Ej. 100.00" required>
                    </div>

                    <!-- Rango (zona, sector, etc.) -->
                    <div>
                        <label for="rango" class="block mb-1 text-sm font-medium text-gray-800">Fraccionamiento</label>
                        <select required id="rango" name="rango"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50">
                            <option value="" disabled selected>Seleccionar fraccion</option>
                            <option value="mensual">Mensual</option>
                            <option value="semanal">Semanal</option>
                            <option value="quincenal" disabled>Quincenal</option>
                            <option value="diario">Diario (Lunes a Sábados)</option>
                        </select>
                    </div>

                    <!-- Cantidad de cuotas -->
                    <div>
                        <label for="cantidad_cuotas" class="block mb-1 text-sm font-medium text-gray-800">
                            Cantidad de cuotas
                        </label>
                        <input type="number" id="cantidad_cuotas" name="cantidad_cuotas"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50"
                            placeholder="Ej. 12" min="1" required>
                    </div>

                    <!-- Fecha de inicio -->
                    <div>
                        <label for="fecha_inicio" class="block mb-1 text-sm font-medium text-gray-800">Fecha de
                            inicio</label>
                        <input type="date" id="fecha_inicio" name="fecha_inicio"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50"
                            required>
                    </div>

                    <!-- Fecha fin estimada -->
                    <div>
                        <label for="fecha_fin_estimado" class="block mb-1 text-sm font-medium text-gray-800">Fecha fin
                            estimada</label>
                        <input type="date" id="fecha_fin_estimado" name="fecha_fin_estimado"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50"
                            required>
                    </div>
            
                    <!-- Observaciones -->
                    <div>
                        <label for="observaciones"
                            class="block mb-1 text-sm font-medium text-gray-800">Observaciones</label>
                        <textarea id="observaciones" name="observaciones" rows="3"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50"
                            placeholder="Notas sobre el cliente o contrato..."></textarea>
                    </div>

                    <!-- Botón de guardar -->
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 rounded-lg shadow transition flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i> Guardar contrato
                    </button>
                </form>
            </div>
        </div>
    </div>
    <x-buscar-cliente />
</div>
