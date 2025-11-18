<div>
    <div class="bg-gray-100 rounded-lg shadow-sm p-3 text-center">
        <p class="text-xs text-gray-500">Cobros hoy</p>
        <p id="cobrado" class="text-xl font-bold text-green-700">Gs. {{ format_monto($cobrado) }}</p>
        <p id="monto-cobrar" class="text-xs text-gray-500 font-semibold">de Gs. {{ format_monto($montoCobrar) }}</p>
    </div>
    <div class="bg-gray-100 rounded-lg shadow p-3 text-center">
        <p class="text-xs text-gray-500">Clientes hoy</p>
        <p id="pagos" class="text-xl font-bold text-gray-800">{{ $pagosCompletados }}/{{ $cantidadPagos }}</p>
        <p class="text-xs text-gray-400">completados</p>
    </div>
</div>
