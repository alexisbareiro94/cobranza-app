<div id="exportarPagosModal" class="hidden fixed inset-0 bg-black/20 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96 max-w-[90%]">
        <h3 class="text-lg font-semibold mb-4">Exportar Pagos</h3>
        <p class="text-gray-700 mb-6">Se exportarán los pagos filtrados en formato Excel. ¿Deseas continuar?</p>
        <div class="flex justify-end space-x-3">
            <form action="{{ route('historial.exportar') }}" method="post">
                @csrf
                <button id="cancelExportBtn" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancelar</button>
                <button id="confirmExportBtn"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Exportar</button>
            </form>
        </div>
    </div>
</div>
