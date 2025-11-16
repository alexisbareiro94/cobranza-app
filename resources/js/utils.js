import moment from 'moment';
import 'moment/locale/es';

moment.locale('es'); // Configuración global

export const csrfToken = document.querySelector("meta[name='csrf-token']").getAttribute('content');
export const url = 'http://127.0.0.1:8000/api'

export function showToast(message, type = 'success') {
    const toastCont = document.getElementById('toast-container');
    toastCont.classList.remove('hidden');
    const typeClass = type == 'error' ? 'bg-red-500' : 'bg-blue-500';
    const textColoer = type == 'error' ? 'text-red-500' : 'text-blue-500';
    const svg = type == 'error' ? ` 
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path
                        d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                </svg>` : `  
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>`;
    toastCont.innerHTML = ` 
        <div class="relative flex items-center ${typeClass} text-white text-sm w-full font-bold px-4 py-3"
            role="alert">
            <p class="mx-auto flex gap-2">
                ${svg}

                ${message}
            </p>
            <button id='cerrar-toast' class="bg-white ${textColoer} px-2 rounded-md cursor-pointer">
                x
        </div>`

    document.getElementById('cerrar-toast').addEventListener('click', () => {
        console.log('message')
        document.getElementById('toast-container').classList.add('hidden')
    })


    document.getElementById('toast-container').addEventListener('click', e => {
        if (e.target == document.getElementById('toast-container')) {
            document.getElementById('toast-container').classList.add('hidden');
        }
    })
    setTimeout(() => {
        toastCont.classList.add('hidden');
    }, 5000);
}


export const $ = el => document.querySelector(el);
export const $$ = el => document.querySelectorAll(el);

export const $el = (el, e, call) => {
    const de = document.querySelector(el);
    return de.addEventListener(e, call);
};


export const $$el = (el, e, call) => {
    const de = document.querySelectorAll(el);
    return de.addEventListener(e, call)
}

export const formatDate = value => {
    const fecha = new Date(value);
    return fecha.toLocaleString('es-PY', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
    }).replace(',', ' -');
}

export const formatDateHora = value => {
    const fecha = new Date(value);
    return fecha.toLocaleString('es-PY', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',        
        hour12: false,
    }).replace(',', ' -');
}


export function setEstadoPago(estado) {
    const estados = {
        pagado: 'Pagado',
        parcial: 'Parcial',
        no_pagado: 'No Pagado',
        pendiente: 'Pendiente'
    };

    return estados[estado] || null;
}

export function setCiudad(id) {
    const ciudades = {
        20: 'Asuncion',
        1: "Areguá",
        2: "Capiatá",
        3: "Fernando de la Mora",
        4: "Guarambaré",
        5: "Itá",
        6: "Itauguá",
        7: "Julián Augusto Saldívar",
        8: "Lambaré",
        9: "Limpio",
        10: "Luque",
        11: "Mariano Roque Alonso",
        12: "Ñemby",
        13: "Nueva Italia",
        14: "San Antonio",
        15: "San Lorenzo",
        16: "Villa Elisa",
        17: "Villeta",
        18: "Ypacaraí",
        19: "Ypané"
    };

    return ciudades[id] || null;
}


export function formatFecha(fecha, diff = false) {
    const fechaForm = moment(fecha);

    if (fechaForm.isSame(moment(), 'day')) {
        return 'hoy';
    }

    if (diff) {
        const dias = moment().diff(fechaForm, 'days');

        if (dias >= 7 && dias < 30) {
            const semanas = Math.floor(dias / 7);
            return `hace ${semanas} ${semanas === 1 ? 'semana' : 'semanas'}`;
        }

        return fechaForm.fromNow();
    } else {
        return fechaForm.format('DD-MM-YYYY');
    }
}


export function verificarFecha(valor) {
    const fecha = moment(valor);
    const hoy = moment().startOf('day'); // para comparar solo la fecha sin hora

    if (fecha.isBefore(hoy, 'day')) {
        return 'Venció';
    } else {
        return 'Vence';
    }
}

export const MAPBOX_TOKEN = "pk.eyJ1IjoiYWxleGlzZ2IiLCJhIjoiY203bWI0ZWNqMGloNzJrcTVzOTFhY3d5NCJ9.teEQeq-xDdyTSJtX5qGtTw";

export function abrirModalConAnimacion(divToAnimate) {
    const modal = $(`#${divToAnimate}`)
    if (modal.classList.contains('animate-modal-out')) {
        modal.classList.replace('animate-modal-out', "animate-modal-in")
    }
}

export function cerrarModalConAnimacion(modalPrincipal, modalToAnimate) {
    const modalUno = $(`#${modalPrincipal}`);
    const modal = $(`#${modalToAnimate}`);
    if (modal.classList.contains('animate-modal-in')) {
        modal.classList.replace('animate-modal-in', 'animate-modal-out');
    } else {
        modal.classList.add('animate-modal-out');
    }

    modal.addEventListener('animationend', () => {
        modalUno.classList.add('hidden');
        modal.classList.remove('animate-modal-out');
        modal.classList.add('animate-modal-in');
    }, { once: true });
}

