<div id="clientModal" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black/40">
    <div class="relative p-4 w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Modal header -->
            <div class="bg-white p-4 text-green-700 border-b-2 border-green-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        Información del Cliente
                    </h3>
                    <button id="closeModal"
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
            <div class="p-6 space-y-6">
                <!-- Información Personal -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-green-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        Información Personal
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Nombre</p>
                            <p class="text-gray-800 font-medium" id="client-nombre">Juan Pérez</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Número de CI</p>
                            <p class="text-gray-800 font-medium" id="client-ci">1234567</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Correo Electrónico</p>
                            <p class="text-gray-800 font-medium" id="client-correo">juan.perez@ejemplo.com</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Teléfono</p>
                            <p class="text-gray-800 font-medium" id="client-telefono">+595 123 456 789</p>
                        </div>
                    </div>
                </div>

                <!-- Información de Contacto -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-green-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        Información de Contacto
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Dirección</p>
                            <p class="text-gray-800 font-medium" id="client-direccion">Av. Principal 123, Asunción</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Ciudad</p>
                            <p class="text-gray-800 font-medium" id="client-ciudad">Asunción</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Referencia</p>
                            <p class="text-gray-800 font-medium" id="client-referencia">Cerca del mercado 4</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Ubicación</p>
                            <p class="text-gray-800 font-medium" id="client-geo">-25.2800459, -57.6343814</p>
                        </div>
                    </div>
                </div>

                <!-- Información del Cobrador -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-green-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                        </svg>
                        Cobrador Asignado
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Cobrador</p>
                            <p class="text-gray-800 font-medium" id="client-cobrador">Carlos González</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Estado</p>
                            <span id="client-estado"
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                ✓ Activo
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Resumen de Préstamos -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-green-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                        </svg>
                        Resumen de Préstamos
                    </h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <div class="bg-blue-50 p-3 rounded-lg text-center">
                            <p class="text-xs text-blue-600 mb-1">Total Préstamos</p>
                            <p class="text-2xl font-bold text-blue-700" id="total-prestamos">3</p>
                        </div>
                        <div class="bg-green-50 p-3 rounded-lg text-center">
                            <p class="text-xs text-green-600 mb-1">Activos</p>
                            <p class="text-2xl font-bold text-green-700" id="prestamos-activos">2</p>
                        </div>
                        <div class="bg-yellow-50 p-3 rounded-lg text-center">
                            <p class="text-xs text-yellow-600 mb-1">Pendientes</p>
                            <p class="text-2xl font-bold text-yellow-700" id="prestamos-pendientes">1</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg text-center">
                            <p class="text-xs text-gray-600 mb-1">Finalizados</p>
                            <p class="text-2xl font-bold text-gray-700" id="prestamos-finalizados">1</p>
                        </div>
                    </div>
                </div>

                <!-- Préstamos Activos -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                        Préstamos Activos
                    </h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-white">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                        Código</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Monto
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                        Cuotas</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Saldo
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                        Estado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100" id="prestamos-activos-table">
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-600 font-medium">PR-001</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">Gs. 1.500.000</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">5/12</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">Gs. 875.000</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                            Activo
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-600 font-medium">PR-002</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">Gs. 2.000.000</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">2/8</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">Gs. 1.500.000</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                            Activo
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Próximos Pagos -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                        Próximos Pagos
                    </h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-white">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                        Préstamo</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Cuota
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Monto
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                        Vencimiento</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                        Estado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100" id="proximos-pagos-table">
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-600 font-medium">PR-001</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">6</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">Gs. 125.000</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">15/10/2023</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                            Pendiente
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-600 font-medium">PR-002</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">3</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">Gs. 250.000</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">20/10/2023</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                            Pendiente
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pie del Modal -->
            <div class="flex justify-end gap-3 p-4 bg-gray-50 border-t">
                <button id="closeModalBtn"
                    class="px-6 py-2 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Script básico para abrir y cerrar el modal
    const clientModal = document.getElementById('clientModal');
    const closeModalButtons = ['closeModal', 'closeModalBtn'];

    closeModalButtons.forEach(id => {
        const btn = document.getElementById(id);
        if (btn) {
            btn.addEventListener('click', function() {
                clientModal.classList.add('hidden');
            });
        }
    });

    // Cerrar modal al hacer clic fuera del contenido
    window.addEventListener('click', function(event) {
        if (event.target === clientModal) {
            clientModal.classList.add('hidden');
        }
    });
</script>
