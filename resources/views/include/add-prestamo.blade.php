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

                    <!-- Monto prestado -->
                    <div>
                        <label for="monto_prestado" class="block mb-1 text-sm font-medium text-gray-800">
                            Monto a prestar
                        </label>
                        <input type="number" step="0.01" id="monto_prestado" name="monto_prestado"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50"
                            placeholder="Ej. 1000.00"
                            @if (isset($configPrestamos) && $configPrestamos) min="{{ $configPrestamos->monto_minimo }}"
                                max="{{ $configPrestamos->monto_maximo }}" @endif
                            required>
                        @if (isset($configPrestamos) && $configPrestamos)
                            <p class="text-xs text-gray-500 mt-1">
                                Rango: Gs. {{ number_format($configPrestamos->monto_minimo, 0, ',', '.') }} - Gs.
                                {{ number_format($configPrestamos->monto_maximo, 0, ',', '.') }}
                            </p>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Interés -->
                        <div>
                            <label for="porcentaje_interes" class="block mb-1 text-sm font-medium text-gray-800">
                                Interés (%)
                            </label>
                            <input type="number" step="0.1" id="porcentaje_interes" name="porcentaje_interes"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50"
                                placeholder="Ej. 10" value="{{ $configPrestamos->tasa_interes_default ?? '' }}"
                                required>
                        </div>
                        <!-- Mora -->
                        <div>
                            <label for="monto_mora" class="block mb-1 text-sm font-medium text-gray-800">
                                Mora (Fijo)
                            </label>
                            <input type="number" step="0.01" id="monto_mora" name="monto_mora"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50"
                                placeholder="Ej. 50.00" value="{{ $configPrestamos->monto_mora_default ?? '' }}"
                                required>
                        </div>
                    </div>

                    <!-- Monto total (Calculado) -->
                    <div>
                        <label for="monto_total" class="block mb-1 text-sm font-medium text-gray-800">
                            Monto total (con Interés)
                        </label>
                        <input type="number" step="0.01" id="monto_total" name="monto_total"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 outline-none cursor-not-allowed"
                            placeholder="0.00" readonly required>
                    </div>

                    <!-- Rango (zona, sector, etc.) -->
                    <div>
                        <label for="rango"
                            class="block mb-1 text-sm font-medium text-gray-800">Fraccionamiento</label>
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
                            placeholder="Ej. 12"
                            @if (isset($configPrestamos) && $configPrestamos) min="{{ $configPrestamos->cuotas_minimas }}"
                                max="{{ $configPrestamos->cuotas_maximas }}"
                            @else
                                min="1" @endif
                            required>
                        @if (isset($configPrestamos) && $configPrestamos)
                            <p class="text-xs text-gray-500 mt-1">
                                Rango: {{ $configPrestamos->cuotas_minimas }} - {{ $configPrestamos->cuotas_maximas }}
                                cuotas
                            </p>
                        @endif
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

<!-- Modal: Confirmación -->
<div id="modal-confirmar-contrato"
    class="hidden fixed inset-0 z-[60] flex justify-center items-center w-full h-full bg-black/50 backdrop-blur-sm">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div
            class="relative bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden transform transition-all">
            <!-- Header -->
            <div class="bg-gradient-to-r from-green-600 to-emerald-600 p-4">
                <h3 class="text-lg font-bold text-white flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    Confirmar Préstamo
                </h3>
            </div>

            <!-- Body -->
            <div class="p-6 space-y-4">
                <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                    <p class="text-sm text-green-800 font-medium mb-1">Resumen de la operación</p>
                    <div class="flex justify-between items-end">
                        <div>
                            <span class="text-xs text-green-600 uppercase tracking-wider">Monto a Entregar</span>
                            <p class="text-2xl font-bold text-green-700" id="conf-monto-prestado">$0.00</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-green-600 uppercase tracking-wider">Total a Cobrar</span>
                            <p class="text-xl font-bold text-green-700" id="conf-monto-total">$0.00</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-3 text-sm text-gray-600">
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span>Cliente:</span>
                        <span class="font-semibold text-gray-800" id="conf-cliente">-</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span>Interés:</span>
                        <span class="font-semibold text-gray-800" id="conf-interes">0%</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span>Mora (Fijo):</span>
                        <span class="font-semibold text-gray-800" id="conf-mora">$0.00</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span>Plan de Pagos:</span>
                        <span class="font-semibold text-gray-800">
                            <span id="conf-cuotas">0</span> cuotas de <span id="conf-monto-cuota">$0.00</span>
                        </span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span>Frecuencia:</span>
                        <span class="font-semibold text-gray-800 capitalize" id="conf-frecuencia">-</span>
                    </div>
                    <div class="flex justify-between pt-1">
                        <span>Vencimiento estimado:</span>
                        <span class="font-semibold text-gray-800" id="conf-fecha-fin">-</span>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="p-4 bg-gray-50 flex gap-3 justify-end border-t border-gray-100">
                <button type="button" id="btn-cancelar-confirmacion"
                    class="px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 font-medium transition-colors shadow-sm">
                    Volver
                </button>
                <button type="button" id="btn-confirmar-guardar"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium transition-colors shadow-md flex items-center">
                    Confirmar y Crear <i class="fas fa-arrow-right ml-2 text-sm"></i>
                </button>
            </div>
        </div>
    </div>
</div>
