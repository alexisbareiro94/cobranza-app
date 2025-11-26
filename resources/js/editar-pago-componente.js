import axios from "axios";
import { $, $$, $el, abrirModalConAnimacion, cerrarModalConAnimacion, formatDate, csrfToken, showToast, setEstadoPago } from "./utils";

const btns = $$('.editar-pago');
const modal = $('#modal-editar-pago');

btns.forEach(btn => {
    btn.addEventListener('click', async () => {
        modal.classList.remove('hidden');
        abrirModalConAnimacion($('#pagos-animate').id);

        const id = btn.dataset.id;
        const res = await getDatosPago(id);
        const data = res.data;
        const editarPagoCodigo = $('#editar-pago-codigo');
        const editarPagoCuota = $('#editar-pago-cuota');
        const editarPagoVencimiento = $('#editar-pago-vencimiento');
        const editarPagoMontoEsperado = $('#editar-pago-monto-esperado');
        const editarPagoMontoPagado = $('#editar-pago-monto-pagado');
        const editarPagoFechaPago = $('#editar-pago-fecha-pago');
        const editarPagoEstado = $('#editar-pago-estado');
        const editarPagoCliente = $('#editar-pago-cliente');
        const editarPagoPrestamo = $('#editar-pago-prestamo');
        const fechaPagoEdit = $('#fecha-pago-edit');
        const montoPagadoEdit = $('#monto-pagado-edit');
        const observacionesEdit = $('#observaciones-pago-edit');
        const estadoPagoEdit = $('#estado-pago-edit');
        const historialId = $('#historial-id');
        const alertaPosibleError = $('#alerta-posible-error');

        editarPagoCodigo.textContent = `#${data.pago.codigo}`;
        editarPagoCuota.textContent = data.pago.numero_cuota;
        editarPagoVencimiento.textContent = formatDate(data.pago.vencimiento);
        editarPagoMontoEsperado.textContent = data.pago.monto_esperado.toLocaleString('es-PY', { style: 'currency', currency: 'PYG' });
        editarPagoMontoPagado.textContent = data.monto.toLocaleString('es-PY', { style: 'currency', currency: 'PYG' });
        editarPagoFechaPago.textContent = formatDate(data.pago.fecha_pago);
        editarPagoEstado.textContent = data.pago.estado;
        observacionesEdit.value = data.pago.observaciones;
        montoPagadoEdit.value = data.monto;

        editarPagoCliente.textContent = data.pago.cliente.nombre;
        editarPagoPrestamo.textContent = data.prestamo.codigo;
        historialId.value = data.id;

        fechaPagoEdit.value = data.created_at.substring(0, 10);

        for (let i = 0; i < estadoPagoEdit.options.length; i++) {
            if (estadoPagoEdit.options[i].value === data.pago.estado) {
                estadoPagoEdit.options[i].selected = true;
                break;
            }
        }

        if (data.pago.monto_pagado !== data.pago.monto_esperado) {
            alertaPosibleError.classList.remove('hidden');
        } else {
            alertaPosibleError.classList.add('hidden');
        }
    });
});


const cerrarBtns = $$('.cerrar-editar-pago');

cerrarBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        cerrarModalConAnimacion($('#modal-editar-pago').id, $('#pagos-animate').id);
    });
});


async function getDatosPago(id) {
    try {
        const res = await axios.get(`api/historial/${id}`);
        const data = res.data;
        return data;
    } catch (error) {
        console.error(error);
    }
}


if ($('#form-editar-pago')) {
    $el('#form-editar-pago', 'submit', async e => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData.entries());
        console.log(data);
        // return;
        try {
            await axios.post(`api/historial/${data.id}`, data, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            });

            sessionStorage.setItem('historial-editado', JSON.stringify('true'));
            window.location.reload();

        } catch (error) {
            console.error(error);
        }
    });
}

const historialEditado = sessionStorage.getItem('historial-editado');
if (historialEditado) {
    sessionStorage.removeItem('historial-editado');
    showToast('Historial editado correctamente', 'success');
}

if ($('#btn-filtrar')) {
    $el('#btn-filtrar', 'click', async e => {
        e.preventDefault();
        const clienteId = $('#filtro-clientes').value;
        const estado = $('#filtro-estado').value;
        const mes = $('#filtro-mes').value;
        const anio = $('#filtro-anio').value;

        try {
            const res = await axios.get(`api/historial`, {
                params: {
                    cliente_id: clienteId || null,
                    estado: estado || null,
                    mes: mes || null,
                    anio: anio || null,
                },
            });
            const data = res.data;
            rederTablePagos(data);
        } catch (error) {
            console.error(error);
        }
    });
}

if ($('#form-filtrar')) {
    var timer;
    $el('#form-filtrar', 'input', async e => {
        e.preventDefault();
        const clienteId = $('#filtro-clientes').value;
        const estado = $('#filtro-estado').value;
        const mes = $('#filtro-mes').value;
        const anio = $('#filtro-anio').value;
        const search = $('#search-input').value;

        clearTimeout(timer);
        timer = setTimeout(async () => {
            try {
                const res = await axios.get(`api/historial`, {
                    params: {
                        cliente_id: clienteId || null,
                        estado: estado || null,
                        mes: mes || null,
                        anio: anio || null,
                        q: search || null,
                    },
                });
                const data = res.data;
                rederTablePagos(data);
            } catch (error) {
                console.error(error);
            }
        }, 500);
    });
}

function rederTablePagos(data) {
    console.log(data);
    const tableBody = $('#lista-pagos');
    tableBody.innerHTML = '';
    data.data.forEach(pago => {
        var estadoClass = '';
        if (pago.pago.estado === 'pagado') {
            estadoClass = 'text-xs px-2 py-1 rounded font-semibold text-green-700 bg-green-200';
        } else if (pago.pago.estado === 'pendiente') {
            estadoClass = 'text-xs px-2 py-1 rounded font-semibold text-yellow-700 bg-yellow-200';
        } else if (pago.pago.estado === 'no_pagado') {
            estadoClass = 'text-xs px-2 py-1 rounded font-semibold text-red-700 bg-red-200';
        } else {
            estadoClass = 'text-xs px-2 py-1 rounded font-semibold text-orange-700 bg-orange-200';
        }

        const tr = document.createElement('tr');
        tr.innerHTML = `
                            <td class="py-3 px-4 border-b text-sm">${formatDate(pago.created_at)}</td>
                            <td class="py-3 px-4 border-b text-sm">${pago.pago.cliente.nombre}</td>
                            <td class="py-3 px-4 border-b text-sm font-medium">Gs. ${pago.monto.toLocaleString('es-PY', { style: 'currency', currency: 'PYG' })}</td>
                            <td class="py-3 px-4 border-b">
                                <span id="prueba" class="${estadoClass}"    >
                                        ${setEstadoPago(pago.pago.estado)}
                                    </span>
                                </td>

                                <td class="py-3 px-4 border-b text-sm text-gray-500">#${pago.pago.codigo}</td>
                                <td class="py-3 px-4 border-b">
                                    <div class="flex space-x-2">
                                        <button data-id="${pago.id}"
                                            class="editar-pago text-blue-600 hover:text-blue-800 text-sm cursor-pointer transition-all active:scale-90">
                                            <i class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </i>
                                        </button>
                                    </div>
                                </td>
        `
        tableBody.appendChild(tr);
    })

    const paginacion = $('#paginacion-pagos');
    if (data.paginacion) {
        paginacion.classList.remove('hidden');
    } else {
        paginacion.classList.add('hidden');
    }
}


if ($('#btn-exportar')) {
    $el('#btn-exportar', 'click', async e => {
        e.preventDefault();
        $('#exportarPagosModal').classList.remove('hidden');

    })


    $el('#cancelExportBtn', 'click', async e => {
        e.preventDefault();
        $('#exportarPagosModal').classList.add('hidden');
    })

    // $el('#confirmExportBtn', 'click', async e => {
    //     e.preventDefault();
    //     $('#exportarPagosModal').classList.add('hidden');

    // })
}

