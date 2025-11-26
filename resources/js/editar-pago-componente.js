import axios from "axios";
import { $, $$, $el, abrirModalConAnimacion, cerrarModalConAnimacion, formatDate, csrfToken, showToast } from "./utils";

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
            const res = await axios.post(`api/historial/${data.id}`, data, {
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