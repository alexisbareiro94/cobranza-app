import { $, $el, url, formatDate } from './utils'
import axios from 'axios';


const getPago = async (id) => {
    try {
        const res = await axios.get(`${url}/pago/${id}`);
        return res.data.data
    } catch (err) {
        console.log(err)
    }
}

$el("#gestionar-pago", 'click', async e => {
    const gestionPago = $('#modal-gestion-pago');
    const modal = $("#modal-in-out")
    if (modal.classList.contains('animate-modal-out')) {
        modal.classList.replace('animate-modal-out', "animate-modal-in")
    }
    gestionPago.classList.remove('hidden')
    const id = e.target.dataset.id;
    const pago = await getPago(id);

    console.log(pago);

    const codigo = $("#pago-codigo");
    const nroCuota = $("#nro-cuota-pago");
    const vence = $("#vence-pago");
    const cliente = $("#cliente-pago");
    const monto = $("input[id='monto-pago-pago']");
    // const estado = $("#estado-pago");
    // const observaciones = $("observaciones-pago");    
    codigo.innerText = `código: #${pago.codigo}`
    codigo.dataset.code = pago.codigo;
    nroCuota.innerText = `Numero de cuota: ${pago.numero_cuota}`
    vence.innerText = formatDate(pago.vencimiento);
    cliente.innerText = `${pago.cliente.nombre}`;
    monto.value = `${pago.monto_esperado}`;

})


$('#cerrar-modal-gestion-pago').addEventListener('click', e => {
    const gestionPago = $('#modal-gestion-pago');
    const modal = $("#modal-in-out");
    if (modal.classList.contains('animate-modal-in')) {
        modal.classList.replace('animate-modal-in', 'animate-modal-out');
    } else {
        modal.classList.add('animate-modal-out');
    }

    modal.addEventListener('animationend', () => {
        gestionPago.classList.add('hidden');
        modal.classList.remove('animate-modal-out');
        modal.classList.add('animate-modal-in');
    }, { once: true });
});


$('#modal-gestion-pago').addEventListener('click', e => {
    if (e.target == $("#modal-gestion-pago")) {
        const gestionPago = $('#modal-gestion-pago');
        const modal = $("#modal-in-out");
        if (modal.classList.contains('animate-modal-in')) {
            modal.classList.replace('animate-modal-in', 'animate-modal-out');
        } else {
            modal.classList.add('animate-modal-out');
        }

        modal.addEventListener('animationend', () => {
            gestionPago.classList.add('hidden');
            modal.classList.remove('animate-modal-out');
            modal.classList.add('animate-modal-in');
        }, { once: true });
    }
})

$el('#form-gestion-pago', 'submit', async e => {
    e.preventDefault();
    const codigo = $("#pago-codigo").dataset.code;
    const monto = $("input[id='monto-pago-pago']").value;
    const estado = $("#estado-pago").value;
    const observaciones = $("textarea[id='observaciones-pago']").value;

    console.log(monto, estado, observaciones)

    const data = new FormData();
    data.append('monto', monto);
    data.append('estado', estado);
    data.append('observaciones', observaciones);

    try {
        const res = await axios.post(`${url}/pago/${codigo}`, data);
        console.log(res)
    } catch (err) {

    }

})
