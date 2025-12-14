// Prestamos.js - Manejo de filtros y búsqueda para la vista de préstamos

document.addEventListener('DOMContentLoaded', function() {
    const filtroEstado = document.getElementById('filtro-estado-prestamo');
    const filtroClientes = document.getElementById('filtro-clientes-prestamo');
    const searchCodigo = document.getElementById('search-codigo');
    const btnFiltrar = document.getElementById('btn-filtrar-prestamos');
    const btnLimpiar = document.getElementById('btn-limpiar-filtros');

    // Función para aplicar filtros
    function aplicarFiltros() {
        const estado = filtroEstado?.value || '';
        const clienteId = filtroClientes?.value || '';
        const codigo = searchCodigo?.value || '';

        const params = new URLSearchParams(window.location.search);

        if (estado) {
            params.set('estado', estado);
        } else {
            params.delete('estado');
        }

        if (clienteId) {
            params.set('cliente_id', clienteId);
        } else {
            params.delete('cliente_id');
        }

        if (codigo) {
            params.set('codigo', codigo);
        } else {
            params.delete('codigo');
        }

        // Redirigir con los nuevos parámetros
        window.location.search = params.toString();
    }

    // Función para limpiar filtros
    function limpiarFiltros() {
        if (filtroEstado) filtroEstado.value = '';
        if (filtroClientes) filtroClientes.value = '';
        if (searchCodigo) searchCodigo.value = '';

        // Limpiar URL
        window.location.href = window.location.pathname;
    }

    // Event listeners
    if (btnFiltrar) {
        btnFiltrar.addEventListener('click', aplicarFiltros);
    }

    if (btnLimpiar) {
        btnLimpiar.addEventListener('click', limpiarFiltros);
    }

    // Permitir buscar con Enter
    if (searchCodigo) {
        searchCodigo.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                aplicarFiltros();
            }
        });
    }

    // Restaurar valores de filtros desde URL
    const urlParams = new URLSearchParams(window.location.search);

    if (filtroEstado && urlParams.has('estado')) {
        filtroEstado.value = urlParams.get('estado');
    }

    if (filtroClientes && urlParams.has('cliente_id')) {
        filtroClientes.value = urlParams.get('cliente_id');
    }

    if (searchCodigo && urlParams.has('codigo')) {
        searchCodigo.value = urlParams.get('codigo');
    }
});
