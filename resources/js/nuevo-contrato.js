import { csrfToken, url, showToast } from './utils'
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

document.getElementById('btn-open-nuevo-cargo').addEventListener('click', () => {
    document.getElementById('modal-add-cargo').classList.remove('hidden');
});


document.getElementById('rango').addEventListener('change', () => {
    setCantidadCuotas();

});


function setCantidadCuotas(){
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

    while (fechas.length < cuotas) {
        if (fechaTemp.day() !== 0) {
            fechas.push(fechaTemp.format('YYYY-MM-DD'));
            fechaFinEstimado.value = fechaTemp.format('YYYY-MM-DD');
            contador++;
        }
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
        const res = await fetch(`${url}/prestamo`, {
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
        showToast('Préstamo Registrado con éxito');
        console.log(data)
    } catch (err) {
        console.log(err)
        // err.error.forEach(item => {
            showToast(`${err.error}`, 'error')
        // })
    }
})
