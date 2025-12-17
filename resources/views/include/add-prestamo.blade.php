<div id="modal-add-cargo"
    class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black/40 backdrop-blur-sm transition-opacity">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div
            class="relative bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden flex flex-col max-h-[90vh]">

            <div class="bg-gray-100 p-4 text-green-700 shadow-md z-10 shrink-0">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold flex items-center gap-2">
                        <i class="fas fa-file-signature"></i>
                        Nuevo Contrato
                    </h3>
                    <button id="cerrar-modal-add-contrato"
                        class="text-black hover:bg-white/20 hover:text-white rounded-full w-8 h-8 flex items-center justify-center transition">
                        x
                    </button>
                </div>
            </div>

            <div class="p-6 overflow-y-auto custom-scrollbar flex-grow">
                <form id="add-contrato-form" class="space-y-6">

                    <input type="hidden" value="" id="cliente_id" name="cliente_id" required>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700">1. ¿A quién se le presta?</label>

                        <div id="box-sin-cliente" class="relative group">
                            <button type="button" id="btn-buscar-cliente"
                                class="w-full h-24 border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center text-gray-500 bg-gray-50 hover:bg-green-50 hover:border-green-500 hover:text-green-700 transition-all duration-200 cursor-pointer">
                                <i class="fas fa-user-plus text-2xl mb-2"></i>
                                <span class="font-semibold">Clic aquí para seleccionar Cliente</span>
                                <span class="text-xs text-gray-400 group-hover:text-green-600">Es obligatorio
                                    seleccionar uno</span>
                            </button>
                        </div>

                        <div id="cliente-seleccionado-cont"
                            class="hidden relative p-4 border border-green-200 bg-green-50 rounded-xl flex items-center justify-between shadow-sm">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-green-200 flex items-center justify-center text-green-700 font-bold">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-green-600 font-bold uppercase tracking-wider">Cliente
                                        Seleccionado</p>
                                    <h4 class="text-lg font-bold text-gray-800" id="cliente-nombre-display">Nombre del
                                        Cliente</h4>
                                </div>
                            </div>
                            <button type="button" id="btn-cambiar-cliente"
                                class="text-sm text-gray-500 underline hover:text-green-700">
                                Cambiar
                            </button>
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <div class="space-y-4">
                        <h4
                            class="text-sm font-bold text-gray-700 uppercase tracking-wide border-l-4 border-green-500 pl-2">
                            2. Detalles Financieros
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="md:col-span-2">
                                <label for="monto_prestado" class="block mb-1 text-sm font-medium text-gray-700">
                                    <i class="fas fa-money-bill-wave text-green-600 w-5"></i> Monto a Prestar (Capital)
                                </label>
                                <div class="relative">
                                    <span
                                        class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 font-bold">Gs.</span>
                                    <input type="number" step="1" id="monto_prestado" name="monto_prestado"
                                        class="w-full pl-10 pr-4 py-3 text-lg font-bold border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition shadow-sm"
                                        placeholder="0"
                                        @if (isset($configPrestamos) && $configPrestamos) min="{{ $configPrestamos->monto_minimo }}" max="{{ $configPrestamos->monto_maximo }}" @endif
                                        required>
                                </div>
                                @if (isset($configPrestamos) && $configPrestamos)
                                    <p class="text-xs text-gray-400 mt-1 ml-1">
                                        Mín: {{ number_format($configPrestamos->monto_minimo, 0, ',', '.') }} - Máx:
                                        {{ number_format($configPrestamos->monto_maximo, 0, ',', '.') }}
                                    </p>
                                @endif
                            </div>

                            <div>
                                <label for="porcentaje_interes"
                                    class="block mb-1 text-sm font-medium text-gray-600">Interés (%)</label>
                                <input type="number" step="0.1" id="porcentaje_interes" name="porcentaje_interes"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none"
                                    placeholder="Ej. 10" value="{{ $configPrestamos->tasa_interes_default ?? '' }}"
                                    required>
                            </div>

                            <div>
                                <label for="monto_mora" class="block mb-1 text-sm font-medium text-gray-600">Mora Diaria
                                    (Gs)</label>
                                <input type="number" step="1" id="monto_mora" name="monto_mora"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none"
                                    placeholder="Ej. 5000" value="{{ $configPrestamos->monto_mora_default ?? '' }}"
                                    required>
                            </div>

                            <div class="md:col-span-2 bg-green-50 p-3 rounded-lg border border-green-200">
                                <label for="monto_total" class="block mb-1 text-xs font-bold text-green-800 uppercase">
                                    Total a Devolver (Con Interés)
                                </label>
                                <input type="number" step="1" id="monto_total" name="monto_total"
                                    class="w-full bg-transparent text-2xl font-black text-green-700 border-none p-0 focus:ring-0 cursor-default"
                                    placeholder="0" readonly tabindex="-1">
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <div class="space-y-4">
                        <h4
                            class="text-sm font-bold text-gray-700 uppercase tracking-wide border-l-4 border-green-500 pl-2">
                            3. Plan de Pagos
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="rango" class="block mb-1 text-sm font-medium text-gray-700">
                                    <i class="fas fa-calendar-alt text-gray-400 w-5"></i> Frecuencia
                                </label>
                                <select required id="rango" name="rango"
                                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none bg-white">
                                    <option value="" disabled selected>Seleccionar...</option>
                                    <option value="mensual">Mensual</option>
                                    <option value="semanal">Semanal</option>
                                    <option value="diario">Diario (Lunes a Sábados)</option>
                                </select>
                            </div>

                            <div>
                                <label for="cantidad_cuotas" class="block mb-1 text-sm font-medium text-gray-700">
                                    <i class="fas fa-hashtag text-gray-400 w-5"></i> N° Cuotas
                                </label>
                                <input type="number" id="cantidad_cuotas" name="cantidad_cuotas"
                                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none"
                                    placeholder="Ej. 12"
                                    @if (isset($configPrestamos)) min="{{ $configPrestamos->cuotas_minimas }}" max="{{ $configPrestamos->cuotas_maximas }}" @else min="1" @endif
                                    required>
                            </div>

                            <div class="md:col-span-2">
                                <label for="monto_cuota" class="block mb-1 text-sm font-medium text-gray-700">
                                    Monto por Cuota
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">Gs.</span>
                                    <input type="number" step="1" id="monto_cuota" name="monto_cuota"
                                        class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg font-semibold text-gray-800 focus:ring-2 focus:ring-green-500 outline-none"
                                        placeholder="0" required>
                                </div>
                            </div>

                            <div>
                                <label for="fecha_inicio" class="block mb-1 text-sm font-medium text-gray-600">Primer
                                    Vencimiento</label>
                                <input type="date" id="fecha_inicio" name="fecha_inicio"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none text-sm"
                                    required>
                            </div>
                            <div>
                                <label for="fecha_fin_estimado"
                                    class="block mb-1 text-sm font-medium text-gray-600">Finalización Estimada</label>
                                <input type="date" id="fecha_fin_estimado" name="fecha_fin_estimado"
                                    class="w-full px-3 py-2 border border-gray-300 bg-gray-100 text-gray-500 rounded-lg outline-none cursor-not-allowed text-sm"
                                    readonly>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="observaciones" class="block mb-1 text-sm font-medium text-gray-600">Notas /
                            Observaciones</label>
                        <textarea id="observaciones" name="observaciones" rows="2"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none text-sm resize-none"
                            placeholder="Información adicional..."></textarea>
                    </div>

                </form>
            </div>

            <div class="p-4 border-t border-gray-100 bg-gray-50 shrink-0">
                <button type="submit" form="add-contrato-form"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3.5 rounded-lg shadow-md hover:shadow-lg transition-all transform active:scale-[0.98] flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i>
                    Guardar y Generar Contrato
                </button>
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
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        Confirmar Préstamo
                    </h3>
                    <button type="button" id="btn-cerrar-confirmacion"
                        class="text-white/80 hover:bg-white/20 hover:text-white rounded-full w-8 h-8 flex items-center justify-center transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
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
