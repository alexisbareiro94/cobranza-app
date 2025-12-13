<div id="exportarPagosModal" class="hidden fixed inset-0 bg-black/20 items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96 max-w-[90%]">
        <h3 class="text-lg font-semibold mb-4">Exportar Pagos</h3>
        <p class="text-gray-700 mb-6">Se exportarán los pagos según los filtros actuales. ¿Deseas continuar?</p>
        <div class="flex justify-end space-x-3">
            <form action="{{ route('historial.exportar') }}" method="POST" id="form-exportar-modal">
                @csrf
                <input type="hidden" name="cliente_id" id="export_cliente_id">
                <input type="hidden" name="estado" id="export_estado">
                <input type="hidden" name="mes" id="export_mes">
                <input type="hidden" name="anio" id="export_anio">
                <input type="hidden" name="q" id="export_search">

                <button type="button" id="cancelExportBtn"
                    class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancelar</button>
                <button type="submit" id="confirmExportBtn"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Exportar</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('exportarPagosModal');
        const cancelBtn = document.getElementById('cancelExportBtn');
        const form = document.getElementById('form-exportar-modal');

        // Function to open modal (to be called from main view)
        window.openExportModal = () => {
            // Capture values from main view filters
            document.getElementById('export_cliente_id').value = document.getElementById('filtro-clientes')
                ?.value || '';
            document.getElementById('export_estado').value = document.getElementById('filtro-estado')
                ?.value || '';
            document.getElementById('export_mes').value = document.getElementById('filtro-mes')?.value ||
                '';
            document.getElementById('export_anio').value = document.getElementById('filtro-anio')?.value ||
                '';
            document.getElementById('export_search').value = document.getElementById('search-input')
                ?.value || '';

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        };

        const closeModal = () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        };

        cancelBtn.addEventListener('click', closeModal);

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });

        // Optional: close on submit too, though page might stay
        form.addEventListener('submit', () => {
            setTimeout(closeModal, 100);
        });
    });
</script>
