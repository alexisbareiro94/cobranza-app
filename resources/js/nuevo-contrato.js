import { csrfToken, url, showToast, $, $$ } from './utils'
import { renderPrestamos } from './prestamos-component'
import axios from 'axios';
import moment from 'moment';

document.getElementById('btn-buscar-cliente').addEventListener('click', () => {
    document.getElementById('modal-buscar-cliente').classList.remove('hidden')
});

document.getElementById('modal-buscar-cliente').addEventListener('click', e => {
    if (e.target == document.getElementById('modal-buscar-cliente')) {
        document.getElementById('modal-buscar-cliente').classList.add('hidden');
    }
});

document.getElementById('cerrar-modal-buscar-cliente').addEventListener('click', () => {
    document.getElementById('modal-buscar-cliente').classList.add('hidden');
})


document.getElementById('modal-add-cargo').addEventListener('click', e => {
    if (e.target == document.getElementById('modal-add-cargo')) {
        document.getElementById('modal-add-cargo').classList.add('hidden');
        document.getElementById('add-contrato-form').reset();
    }
})
document.getElementById('cerrar-modal-add-contrato').addEventListener('click', () => {
    document.getElementById('modal-add-cargo').classList.add('hidden');
    document.getElementById('add-contrato-form').reset();
});

if(document.getElementById('btn-open-nuevo-cargo')){
    document.getElementById('btn-open-nuevo-cargo').addEventListener('click', () => {
        document.getElementById('modal-add-cargo').classList.remove('hidden');
    });
}


document.getElementById('rango').addEventListener('change', () => {
    setCantidadCuotas();

});


function setCantidadCuotas() {
    const fechaFinEstimado = document.getElementById('fecha_fin_estimado').value;
    const montoTotal = document.getElementById('monto_total').value;
    const montoCuota = document.getElementById('monto_cuota').value;
    const cantidadCuotas = document.getElementById('cantidad_cuotas');

    if (fechaFinEstimado) {
        setFechaFin();
    }

    if (!montoCuota || !montoTotal) {
        return;
    }
    cantidadCuotas.value = '';
    cantidadCuotas.value = Math.round(montoTotal / montoCuota);
    console.log(rango.value, montoTotal, montoCuota)
}

document.getElementById('fecha_inicio').addEventListener('change', () => {
    setFechaFin();
})


let timer;
document.getElementById('monto_cuota').addEventListener('input', () => {
    const fechaFinEstimado = document.getElementById('fecha_fin_estimado').value;
    clearTimeout(timer);
    if (fechaFinEstimado) {
        timer = setTimeout(() => {
            setCantidadCuotas();
        }, 500);
    }
});

function setFechaFin() {
    const fecha = document.getElementById('fecha_inicio').value
    const rango = document.getElementById('rango').value;
    const fechaFinEstimado = document.getElementById('fecha_fin_estimado');
    const cuotas = document.getElementById('cantidad_cuotas').value;
    console.log('message')
    const diccionario = {
        semanal: 'week',
        mensual: 'month',
        quincenal: 'day',
        diario: 'day',
    };
    
    let fraccion;
    Object.entries(diccionario).forEach(([index, value]) => {
        if (index === rango) {
            fraccion = value;
        }
    });

    const fechaInicio = moment(fecha);
    let fechas = [];
    let contador = 0;
    let fechaTemp = fechaInicio.clone();
    console.log(fechaTemp)
    while (fechas.length < cuotas) {        
        if (fechaTemp.day() !== 0) {            
            fechas.push(fechaTemp.format('YYYY-MM-DD'));
            fechaFinEstimado.value = fechaTemp.format('YYYY-MM-DD');            
        }else{            
            fechas.push(fechaTemp.format('YYYY-MM-DD'));
        }
        contador++;
        fechaTemp.add(1, fraccion);
    }

    sessionStorage.setItem('fechas', JSON.stringify(fechas));
}

document.getElementById('add-contrato-form').addEventListener('submit', async e => {
    e.preventDefault();
    const clienteId = document.getElementById('cliente_id').value;

    if (!clienteId) {
        showToast('Selecciona un cliente', 'error')
        return;
    }

    const fechas = JSON.parse(sessionStorage.getItem('fechas'));
    const montoTotal = document.getElementById('monto_total').value;
    const montoCuota = document.getElementById('monto_cuota').value;
    const cantidadCuotas = document.getElementById('cantidad_cuotas').value;
    const fechaInicio = document.getElementById('fecha_inicio').value;
    const fechaFinEstimado = document.getElementById('fecha_fin_estimado').value;
    const observaciones = document.getElementById('observaciones').value;
    const rango = document.getElementById('rango').value

    const formData = new FormData();
    formData.append('cliente_id', clienteId);
    formData.append('monto_total', montoTotal);
    formData.append('monto_cuota', montoCuota);
    formData.append('cantidad_cuotas', cantidadCuotas);
    formData.append('fecha_inicio', fechaInicio);
    formData.append('fecha_fin_estimado', fechaFinEstimado);
    formData.append('observaciones', observaciones);
    formData.append('rango', rango);
    formData.append('fechas', fechas);

    console.log(fechas);

    try {
        const res = await fetch(`/api/prestamo`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            body: formData,
        });
        const data = await res.json();
        if (!res.ok) {
            throw data
        }
        document.getElementById('add-contrato-form').reset();
        document.getElementById('modal-add-cargo').classList.add('hidden');
        document.getElementById('btn-buscar-cliente').innerText = 'Seleccionar Cliente'
        document.getElementById('cliente-seleccionado-cont').classList.add('hidden');
        document.getElementById('cliente_id').value = ''
        renderCliente(clienteId);
        renderPrestamos();        
        showToast('Préstamo Registrado con éxito');
        console.log(data)
    } catch (err) {
        console.log(err)
        // err.error.forEach(item => {
        showToast(`${err.error}`, 'error')
        // })
    }
})


async function renderCliente(id) {
    try {
        const clientes = $$('.clientes');
        clientes.forEach(async cont => {
            if (id == cont.dataset.id) {
                const res = await axios.get(`api/cliente/${id}`);
                const cliente = res.data.data;
                const telefono = cliente.telefono ?
                    ` <p class="text-sm text-gray-500 mt-1">
                📞 ${cliente.telefono}
                </p>` : '';


                const activo = cliente.activo ?
                    `<span class="px-2 py-1 mt-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Activo</span>` : '';


                const correo = cliente.correo ?
                    `<p class="text-sm text-gray-500">📧 ${cliente.correo ?? 'Sin correo'}</p>` : '';

                cont.innerHTML = '';
                cont.innerHTML = `<div class="w-22 h-24 rounded-xl overflow-hidden flex-shrink-0 bg-white">
                    <!-- @if ($cliente->imagen)
                        {{-- <img src="{{ asset('storage/' . $cliente->imagen) }}" alt="{{ $cliente->nombre }}" class="w-full h-full object-cover"> --}}
                    @else 
                        
                    @endif -->

                    <div class="flex items-center justify-center w-full h-full text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 11c2.21 0 4-1.79 4-4S14.21 3 12 3 8 4.79 8 7s1.79 4 4 4zM6 21v-2a4 4 0 014-4h0a4 4 0 014 4v2m6 0v-2a4 4 0 00-4-4h0a4 4 0 00-4 4v2" />
                            </svg>
                        </div>
                </div>

                <!-- Información del cliente -->
                <div class="flex-1 items-center ml-4">
                    <div class="flex gap-2 items-start">
                        <h3 class="text-lg font-semibold text-gray-800">${cliente.nombre}</h3>
                        ${activo}
                    </div>

                    <p class="text-sm text-gray-600 mt-1">${cliente.direccion ?? 'Sin dirección'}</p>

                    ${telefono}

                    ${correo}
                </div>

                <!-- Acciones -->
                <div class="ml-4 flex flex-col gap-2">
                    <a href="#" class="px-3 py-1 bg-emerald-500 text-white text-sm rounded-lg hover:bg-emerald-600">Ver</a>
                    <a href="#" class="px-3 py-1 bg-blue-500 text-white text-sm rounded-lg hover:bg-blue-600">Editar</a>
                </div>`
                console.log(cont)
            } else {
                return;
            }

        })

        console.log(clientes)
    } catch (err) {
        console.log(err)
    }
}