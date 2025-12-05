import axios from 'axios';
import mapboxgl from 'mapbox-gl';
import { MAPBOX_TOKEN, $, $$, $el, showToast } from './utils.js';

// Configurar el token de Mapbox
mapboxgl.accessToken = MAPBOX_TOKEN;

window.addEventListener('DOMContentLoaded', async function () {
    const clienteEditado = sessionStorage.getItem('cliente_editado');
    if (clienteEditado) {
        showToast('Cliente actualizado correctamente', 'success');
        sessionStorage.removeItem('cliente_editado');
    }

    const clienteId = window.location.pathname.split('/').pop();
    console.log('Cliente ID:', clienteId);

    try {
        // Obtener datos del cliente
        const res = await axios.get(`/api/cliente/${clienteId}`);
        const data = res.data.data;
        const geo = data.geo;
        console.log('Datos del cliente:', data);
        console.log('Ubicación geo:', geo);

        // Parsear las coordenadas (formato esperado: "lat,lng")
        if (geo) {
            const [lat, lng] = geo.split(',').map(coord => parseFloat(coord.trim()));

            if (!isNaN(lat) && !isNaN(lng)) {
                // Inicializar el mapa
                const map = new mapboxgl.Map({
                    container: 'map', // ID del contenedor
                    style: 'mapbox://styles/mapbox/streets-v12', // Estilo del mapa
                    center: [lng, lat], // Coordenadas [lng, lat]
                    zoom: 15 // Nivel de zoom
                });

                // Agregar controles de navegación
                map.addControl(new mapboxgl.NavigationControl());

                // Crear un marcador en la ubicación del cliente
                const marker = new mapboxgl.Marker({ color: '#3B82F6' })
                    .setLngLat([lng, lat])
                    .setPopup(
                        new mapboxgl.Popup({ offset: 25 })
                            .setHTML(`
                                <div class="p-2">
                                    <h4 class="font-bold text-gray-800">${data.nombre}</h4>
                                    <p class="text-sm text-gray-600">${data.direccion}</p>
                                </div>
                            `)
                    )
                    .addTo(map);

                // Abrir el popup automáticamente
                marker.togglePopup();
            } else {
                console.error('Coordenadas inválidas:', geo);
                mostrarMensajeError('Las coordenadas del cliente no son válidas');
            }
        } else {
            console.warn('No hay datos de ubicación disponibles');
            mostrarMensajeError('No hay ubicación registrada para este cliente');
        }
    } catch (error) {
        console.error('Error al cargar los datos del cliente:', error);
        mostrarMensajeError('Error al cargar la ubicación del cliente');
    }
});

function mostrarMensajeError(mensaje) {
    const mapContainer = document.getElementById('map');
    if (mapContainer) {
        mapContainer.innerHTML = `
            <div class="flex items-center justify-center h-full bg-gray-100 rounded-lg">
                <p class="text-gray-500 text-center">${mensaje}</p>
            </div>
        `;
    }
}

//informacion personal
$el('#btn-edit-info', 'click', () => {
    const nombre = $('#nombre');
    const ci = $('#ci');
    const correo = $('#correo');
    const telefono = $('#telefono');

    const divBtnsConfirm = document.getElementById('div-btns-confirm');
    divBtnsConfirm.innerHTML = `
                            <p class="text-sm text-gray-500 mt-1">Confirmar cambios?</p>
                            <button id="btn-confirm"
                                class="cursor-pointer transition-all active:scale-90 active:text-green-500 active:bg-green-200 active:rounded-lg p-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </button>

                            <button id="btn-cancel"
                                class="cursor-pointer transition-all active:scale-90 active:text-red-500 active:bg-red-200 active:rounded-lg p-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>

                            </button>
    `

    nombre.disabled = false;
    ci.disabled = false;
    correo.disabled = false;
    telefono.disabled = false;

    nombre.classList.add('bg-gray-100', 'py-1', 'rounded-md', 'px-2');
    ci.classList.add('bg-gray-100', 'py-1', 'rounded-md', 'px-2');
    correo.classList.add('bg-gray-100', 'py-1', 'rounded-md', 'px-2');
    telefono.classList.add('bg-gray-100', 'py-1', 'rounded-md', 'px-2');

    nombre.focus();

    $el('#form-info', 'submit', async e => {
        e.preventDefault();
        const clienteId = $('#cliente_id').value;
        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData.entries());
        console.log(data);
        try {
            const res = await axios.put(`/api/cliente/${clienteId}`, data);
            sessionStorage.setItem('cliente_editado', JSON.stringify('true'));
            window.location.reload();
        } catch (error) {
            console.error('Error al actualizar el cliente:', error);

        }
    });

    $el('#btn-cancel', 'click', () => {
        nombre.disabled = true;
        ci.disabled = true;
        correo.disabled = true;
        telefono.disabled = true;

        nombre.classList.remove('bg-gray-100', 'py-1', 'rounded-md', 'px-2');
        ci.classList.remove('bg-gray-100', 'py-1', 'rounded-md', 'px-2');
        correo.classList.remove('bg-gray-100', 'py-1', 'rounded-md', 'px-2');
        telefono.classList.remove('bg-gray-100', 'py-1', 'rounded-md', 'px-2');

        divBtnsConfirm.innerHTML = ``;
    })
});


//informacion contacto
$el('#btn-edit-contacto', 'click', () => {
    const direccion = $('#direccion');
    const ciudad = $('#ciudades');
    const ciudadText = $('#ciudad-text');
    const ciudadSelect = $('#ciudad');
    const referencia = $('#referencia');
    const geo = $('#geo');
    const btnOpenMaps = $('#btn-open-maps');

    const divBtnsConfirm = document.getElementById('div-btns-contacto');
    divBtnsConfirm.innerHTML = `
                            <p class="text-sm text-gray-500 mt-1">Confirmar cambios?</p>
                            <button id="btn-confirm"
                                class="cursor-pointer transition-all active:scale-90 active:text-green-500 active:bg-green-200 active:rounded-lg p-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </button>

                            <button id="btn-cancel"
                                class="cursor-pointer transition-all active:scale-90 active:text-red-500 active:bg-red-200 active:rounded-lg p-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>

                            </button>
    `


    direccion.disabled = false;
    referencia.disabled = false;
    geo.disabled = false;

    direccion.classList.add('bg-gray-100', 'py-1', 'rounded-md', 'px-2');
    referencia.classList.add('bg-gray-100', 'py-1', 'rounded-md', 'px-2');
    geo.classList.add('bg-gray-100', 'py-1', 'rounded-md', 'px-2');
    btnOpenMaps.classList.remove('hidden');
    ciudadText.classList.add('hidden');
    ciudad.classList.remove('hidden');

    direccion.focus();

    $el('#form-contacto', 'submit', async e => {
        e.preventDefault();
        const clienteId = $('#cliente_id').value;
        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData.entries());

        try {
            const res = await axios.put(`/api/cliente/${clienteId}`, data);
            sessionStorage.setItem('cliente_editado', JSON.stringify('true'));
            window.location.reload();
        } catch (error) {
            console.error('Error al actualizar el cliente:', error);

        }
    });

    $el('#btn-cancel', 'click', () => {
        direccion.disabled = true;
        referencia.disabled = true;
        geo.disabled = true;

        direccion.classList.remove('bg-gray-100', 'py-1', 'rounded-md', 'px-2');
        referencia.classList.remove('bg-gray-100', 'py-1', 'rounded-md', 'px-2');
        geo.classList.remove('bg-gray-100', 'py-1', 'rounded-md', 'px-2');
        btnOpenMaps.classList.add('hidden');
        ciudadText.classList.remove('hidden');
        ciudad.classList.add('hidden');

        divBtnsConfirm.innerHTML = ``;
    })
})