<div id="clientModal" class="hidden fixed inset-0 bg-gray-600/20 overflow-y-auto h-full w-full ">
    <div class="relative top-20 mx-auto p-5 w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <!-- Encabezado del Modal -->
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-xl font-bold text-gray-800">📋 Información del Cliente</h3>
            <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                <span class="text-2xl">✕</span>
            </button>
        </div>

        <!-- Contenido del Modal -->
        <div class="mt-4">
            <!-- Información Personal -->
            <div class="mb-6">
                <h4 class="text-lg font-semibold text-gray-700 mb-3">👤 Información Personal</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Nombre</p>
                        <p class="text-gray-800">Juan Pérez</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Número de CI</p>
                        <p class="text-gray-800">1234567</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Correo Electrónico</p>
                        <p class="text-gray-800">juan.perez@ejemplo.com</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Teléfono</p>
                        <p class="text-gray-800">+595 123 456 789</p>
                    </div>
                </div>
            </div>

            <!-- Información de Contacto -->
            <div class="mb-6">
                <h4 class="text-lg font-semibold text-gray-700 mb-3">📍 Información de Contacto</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Dirección</p>
                        <p class="text-gray-800">Av. Principal 123, Asunción</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Ciudad</p>
                        <p class="text-gray-800">Asunción</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Referencia</p>
                        <p class="text-gray-800">Cerca del mercado 4</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Ubicación</p>
                        <p class="text-gray-800">-25.2800459, -57.6343814</p>
                    </div>
                </div>
            </div>

            <!-- Información del Cobrador -->
            <div class="mb-6">
                <h4 class="text-lg font-semibold text-gray-700 mb-3">👨‍💼 Cobrador Asignado</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Cobrador</p>
                        <p class="text-gray-800">Carlos González</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Estado</p>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            ✅ Activo
                        </span>
                    </div>
                </div>
            </div>

            <!-- Resumen de Préstamos -->
            <div class="mb-6">
                <h4 class="text-lg font-semibold text-gray-700 mb-3">💰 Resumen de Préstamos</h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <p class="text-sm text-blue-600">Total Préstamos</p>
                        <p class="text-lg font-bold text-blue-800">3</p>
                    </div>
                    <div class="bg-green-50 p-3 rounded-lg">
                        <p class="text-sm text-green-600">Activos</p>
                        <p class="text-lg font-bold text-green-800">2</p>
                    </div>
                    <div class="bg-yellow-50 p-3 rounded-lg">
                        <p class="text-sm text-yellow-600">Pendientes</p>
                        <p class="text-lg font-bold text-yellow-800">1</p>
                    </div>
                    <div class="bg-red-50 p-3 rounded-lg">
                        <p class="text-sm text-red-600">Finalizados</p>
                        <p class="text-lg font-bold text-red-800">1</p>
                    </div>
                </div>
            </div>

            <!-- Préstamos Activos -->
            <div class="mb-6">
                <h4 class="text-lg font-semibold text-gray-700 mb-3">📊 Préstamos Activos</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Código</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Monto</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cuotas</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Saldo</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">PR-001</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">1.500.000 ₲</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">5/12</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">875.000 ₲</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Activo
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">PR-002</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">2.000.000 ₲</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">2/8</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">1.500.000 ₲</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Activo
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Próximos Pagos -->
            <div class="mb-6">
                <h4 class="text-lg font-semibold text-gray-700 mb-3">📅 Próximos Pagos</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Préstamo</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cuota</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Monto</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Vencimiento</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">PR-001</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">6</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">125.000 ₲</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">15/10/2023</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Pendiente
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">PR-002</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">3</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">250.000 ₲</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">20/10/2023</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
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
        <div class="flex justify-end pt-4 border-t">
            <button id="closeModalBtn"
                class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition duration-150">
                Cerrar
            </button>
        </div>
    </div>
</div>

<script>
    // Script básico para abrir y cerrar el modal
    document.getElementById('openModal').addEventListener('click', function() {
        document.getElementById('clientModal').classList.remove('hidden');
    });

    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('clientModal').classList.add('hidden');
    });

    document.getElementById('closeModalBtn').addEventListener('click', function() {
        document.getElementById('clientModal').classList.add('hidden');
    });

    // Cerrar modal al hacer clic fuera del contenido
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('clientModal');
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
</script>
