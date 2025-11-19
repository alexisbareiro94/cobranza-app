import { renderClientes } from './add-cliente';
import { $, $el, url, formatDate, showToast, $$, formatFecha, setEstadoPago, setCiudad, verificarFecha, formatDateHora } from './utils'
import axios from 'axios';

gestionPago();
const getPago = async id => {
    try {
        const res = await axios.get(`/api/pago/${id}`);
        return res.data.data
    } catch (err) {
        console.log(err)
    }
}

function gestionPago() {
    const btns = $$('.gestionar-pago');
    btns.forEach(btn => {
        btn.addEventListener('click', async e => {
            const gestionPago = $('#modal-gestion-pago');
            const modal = $("#modal-in-out")
            if (modal.classList.contains('animate-modal-out')) {
                modal.classList.replace('animate-modal-out', "animate-modal-in")
            }
            gestionPago.classList.remove('hidden')
            const id = e.target.dataset.id;
            const pago = await getPago(id);

            const codigo = $("#pago-codigo");
            const nroCuota = $("#nro-cuota-pago");
            const vence = $("#vence-pago");
            const cliente = $("#cliente-pago");
            const monto = $("input[id='monto-pago-pago']");
            const totalPrestamo = $('#total-prestamo-pago');
            const prestamoRestante = $('#prestamo-restante-pago');
            const montoCuota = $('#monto-cuota');
            const pagoParcial = $('#pago-parcial');
            const montoParcial = $('#monto-parcial');
            const fechaPago = $('#fecha-pago');
            console.log(pago)
            codigo.innerText = `código: #${pago.codigo}`
            codigo.dataset.code = pago.codigo;
            nroCuota.innerText = `Numero de cuota: ${pago.numero_cuota}`
            vence.innerText = formatDate(pago.vencimiento);
            cliente.innerText = `${pago.cliente.nombre}`;
            monto.value = `${pago.monto_esperado}`;
            totalPrestamo.innerText = 'Gs. ' + pago.prestamo.monto_total.toLocaleString('es-PY')
            prestamoRestante.innerText = 'Gs. ' + pago.prestamo.saldo_pendiente.toLocaleString('es-PY')
            montoCuota.innerText = 'Gs. ' + pago.monto_esperado.toLocaleString('es-PY');
            console.log(pago.estado)
            if (pago.estado == 'parcial') {
                pagoParcial.classList.remove('hidden');
                montoParcial.innerText = 'Gs. ' + pago.monto_pagado.toLocaleString('es-PY');
                fechaPago.innerText = formatDateHora(pago.updated_at)
            }

            if (pago.estado != 'parcial') {
                pagoParcial.classList.add('hidden');
            }

        })
    })
}

if ($('#cerrar-modal-gestion-pago')) {
    cerrarModal();
}
function cerrarModal() {
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
}

if ($('#modal-gestion-pago')) {
    abrirModal();
}
function abrirModal() {
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
        data.append('monto_pagado', monto);
        data.append('estado', estado);
        data.append('observaciones', observaciones);
        $('#modal-gestion-pago').classList.add('hidden');
        if (!$('#modal-proximos-pagos').classList.contains('hidden')) {
            $('#modal-proximos-pagos').classList.add('hidden');
        }

        try {
            const res = await axios.post(`api/pago/${codigo}`, data);
            showToast('Pago realizado');
            $('#modal-gestion-pago').classList.add('hidden');
            await renderPrestamos();
            renderGanancias();
        } catch (err) {
            console.log(er)
        }
    })
}

// await renderPrestamos();

export async function renderPrestamos() {
    try {
        const res = await axios.get('/api/prestamo');
        console.log(res)
        const data = res.data.data;
        const container = $('#prestamos-container');
        container.innerHTML = '';

        data.forEach(prestamo => {
            const div = document.createElement('div');

            let opciones = `<option value="" selected disabled>Ver Pagos</option>`;

            prestamo.pagos.forEach(pago => {
                const fecha = formatFecha(pago.vencimiento);      // tu función JS
                const estado = setEstadoPago(pago.estado);       // tu función JS
                opciones += `<option value="${pago.id}" disabled>${fecha} ● ${estado}</option>`;
            });


            const estado = prestamo.proximo_pago.estado; // por ejemplo: "pendiente"

            // Definimos las clases según el estado
            const clases = {
                pendiente: 'bg-yellow-200 text-yellow-700',
                parcial: 'bg-orange-300 text-orange-700',
                no_pagado: 'bg-red-200 text-red-700',
                pagado: 'bg-green-200 text-green-700'
            };

            // Construimos el HTML del span
            const span = `
    <span id="prueba" class="text-xs px-2 py-1 rounded font-semibold ${clases[estado] || ''}">
        ${estado.charAt(0).toUpperCase() + estado.slice(1)} <!-- opcional -->
    </span>
`;

            div.innerHTML = `
                <div class="space-y-3 mb-3">
                    <div class="bg-gray-100 rounded-lg shadow p-3 hover:shadow-md  transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="flex" >
                                    <h3 class="font-medium">${prestamo.cliente.nombre}</h3>                    
                                    <select class="ml-3 text-sm px-2 py-1 border border-gray-300 rounded-md"
                                            name="prestamos" id="prestamos">                            
                                        ${opciones}
                                    </select>                    
                                </div>
                                <p class="text-sm text-gray-600">${prestamo.cliente.direccion}, ${setCiudad(prestamo.cliente.ciudad)}</p>
                                <p class="text-sm font-bold text-gray-600 mt-1">
                                    Gs. ${(prestamo.monto_cuota - prestamo.proximo_pago.monto_pagado).toLocaleString('es-PY')} | ${verificarFecha(prestamo.proximo_pago.vencimiento)} ${formatFecha(prestamo.proximo_pago.vencimiento, true)}
                                </p>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <a href="tel:+595${prestamo.cliente.telefono}" class="text-green-600 hover:text-green-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd"
                                            d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>                
                                <a href="https://wa.me/595${prestamo.cliente.telefono}" target="_blank" class="text-green-600 hover:text-green-800 pt-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="" viewBox="0 0 16 16">
                                        <path
                                            d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                    </svg>
                                </a> 
                            </div>
                        </div>
                        <div class="mt-3 flex justify-between items-center relative">
                            ${span}
                            <div class="flex gap-6">
                                <button class="gestionar-pago text-sm font-semibold bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 cursor-pointer transition-all active:scale-90"
                                    data-id="${prestamo.proximo_pago.id}" id="gestionar-pago"
                                >
                                    Gestionar pago
                                </button>
                                <a class="text-blue-600 hover:text-blue-800"
                                    href="https://www.google.com/maps?q={{ $prestamo->cliente->geo }}" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                        <path fill-rule="evenodd"
                                            d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                            <span class="text-gray-500 text-[10px] absolute -bottom-3.5">Código: #${prestamo.proximo_pago.codigo}</span>
                        </div>
                    </div>    
                </div>

`
            container.appendChild(div)
        })
        gestionPago();
        abrirModal();
        cerrarModal();
    } catch (err) {
        console.log(err)
    }
}


export async function renderGanancias() {
    const cobrado = $('#cobrado')
    const montoCobrar = $('#monto-cobrar');
    const pagos = $('#pagos');
    try {
        const res = await axios.get('api/ganancias');
        const data = res.data;
        console.log(data)

        cobrado.innerText = `Gs. ${data.cobrado.toLocaleString('es-PY')}`;
        montoCobrar.innerText = `de Gs. ${data.montoCobrar.toLocaleString('es-PY')}`
        pagos.innerText = `${data.pagosCompletados}/${data.cantidadPagos}`

    } catch (err) {
        console.error(err)
    }
}
