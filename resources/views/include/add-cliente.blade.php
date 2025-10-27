<!-- Main modal -->
<div id="modal-add-cliente" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black/40">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Modal header -->
            <div class="bg-white p-4 text-green-700 border-b border-green-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold">
                        <i class="fas fa-user-plus mr-2"></i>Agregar Cliente
                    </h3>
                    <button id="cerrar-modal-add-cliente"
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
            <div class="p-4 md:p-5 max-h-[80vh] overflow-y-auto">
                <form id="add-cliente-form" class="space-y-4">
                    <!-- Nombre -->
                    <div>
                        <label for="nombre" class="block mb-1 text-sm font-medium text-gray-800">Nombre</label>
                        <input type="text" id="nombre" name="nombre"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50"
                            placeholder="Ej. Ana Martínez" required>
                    </div>

                    <!-- ci -->
                    <div>
                        <label for="nro_ci" class="block mb-1 text-sm font-medium text-gray-800">Numero CI</label>
                        <input type="number" id="nro_ci" name="nro_ci"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50"
                            placeholder="1234567" required>
                    </div>

                    <!-- Correo -->
                    <div>
                        <label for="correo" class="block mb-1 text-sm font-medium text-gray-800">Correo
                            electrónico</label>
                        <input type="email" id="correo" name="correo"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50"
                            placeholder="ana@ejemplo.com" required>
                    </div>

                    <!-- Teléfono -->
                    <div>
                        <label for="telefono" class="block mb-1 text-sm font-medium text-gray-800">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50"
                            placeholder="0981 123 456" required>
                    </div>

                    <!-- Dirección -->
                    <div>
                        <label for="direccion" class="block mb-1 text-sm font-medium text-gray-800">Dirección</label>
                        <input type="text" id="direccion" name="direccion"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50"
                            placeholder="Calle Principal 456" required>
                    </div>

                    <div>
                        <label for="ciudad" class="block mb-1 text-sm font-medium text-gray-800">Ciudad</label>
                        <select name="ciudad" id="ciudad" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50">
                            <option value="" disabled selected>-Seleccionar-</option>
                            <option value="20">Asuncion</option>
                            <option value="1">Areguá</option>
                            <option value="2">Capiatá</option>
                            <option value="3">Fernando de la Mora</option>
                            <option value="4">Guarambaré</option>                                                                                
                            <option value="5">Itá</option>
                            <option value="6">Itauguá</option>
                            <option value="7">Julián Augusto Saldívar</option>                            
                            <option value="8">Lambaré</option>                            
                            <option value="9">Limpio</option>                            
                            <option value="10">Luque</option>                            
                            <option value="11">Mariano Roque Alonso</option>                            
                            <option value="12">Ñemby</option>                            
                            <option value="13">Nueva Italia</option>                            
                            <option value="14">San Antonio</option>                            
                            <option value="15">San Lorenzo</option>                            
                            <option value="16">Villa Elisa</option>                            
                            <option value="17">Villeta</option>                            
                            <option value="18">Ypacaraí</option>
                            <option value="19">Ypané</option>                            
                        </select>
                    </div>

                    <!-- Geo -->
                    <div>
                        <label for="geo" class="block mb-1 text-sm font-medium text-gray-800">Ubicación
                            (Geo)</label>
                        <div class="flex gap-2">
                            <input type="text" id="geo" name="geo"
                                class="flex-1 px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50"
                                placeholder="-25.2637, -57.5759" required>
                            <button id="btn-open-modal-get-geo" type="button"
                                class="px-3 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow active:scale-90 transition flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Imagen -->
                    <div>
                        <label for="imagen" class="block mb-1 text-sm font-medium text-gray-800">Foto (domicilio,
                            cliente)
                            (opcional)</label>
                        <div id="image-cont">
                            <input type="file" id="imagen" name="imagen"
                                class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 px-3 py-2"
                                accept="image/*">
                        </div>
                    </div>

                    <div id="preview-cont" class="hidden flex justify-center mt-3">
                        <div class="relative w-40">
                            <img id="preview" class="w-full rounded-lg border" src="" alt="Vista previa">
                            <button type="button" id="remove-preview"
                                class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                ×
                            </button>
                        </div>
                    </div>

                    {{-- <!-- Activo -->
                    <div class="flex items-center">
                        <input type="checkbox" id="activo" name="activo" value="1"
                            class="w-4 h-4 text-green-600 bg-gray-50 border-gray-300 rounded focus:ring-green-500 focus:ring-2">
                        <label for="activo" class="ml-2 text-sm text-gray-800">Cliente activo</label>
                    </div> --}}

                    <!-- Referencia -->
                    <div>
                        <label for="referencia"
                            class="block mb-1 text-sm font-medium text-gray-800">Referencia</label>
                        <textarea id="referencia" name="referencia" rows="2"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-gray-50"
                            placeholder="Ej: Casa con reja verde, al lado de la panadería"></textarea>
                    </div>

                    <!-- Botón -->
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 rounded-lg shadow transition flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i> Guardar cliente
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para obtener ubicación -->
<div id="modal-get-geo" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black/20">
    <div class="relative p-4 w-[380px] max-w-[90%]">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden font-semibold">
            <div class="bg-white px-6 py-3 text-center flex justify-between">
                <h3 class="text-green-700 font-semibold">Seleccionar ubicación</h3>
                <button>x</button>
            </div>
            <div class="p-4 space-y-3">
                <button id="get-geo"
                    class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg active:scale-90 shadow transition">
                    <i class="fas fa-location-arrow"></i> Usar mi ubicación actual
                </button>
                <a href="https://www.google.com/maps" target="_blank"
                    class="block w-full text-center px-4 py-3 bg-white border border-green-600 text-green-700 font-medium rounded-lg hover:bg-green-50 transition">
                    Abrir en Google Maps
                </a>
            </div>
        </div>
    </div>
</div>
