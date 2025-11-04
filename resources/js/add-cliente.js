import axios from "axios";
import { csrfToken, showToast } from "./utils";

const $ = el => document.getElementById(el);

if(document.getElementById('btn-open-modal-add-cliente')){
    document.getElementById('btn-open-modal-add-cliente').addEventListener('click', () => {
        document.getElementById('modal-add-cliente').classList.remove('hidden');
    });
}

document.getElementById('modal-add-cliente').addEventListener('click', e => {
    if (e.target == document.getElementById('modal-add-cliente')) {
        document.getElementById('modal-add-cliente').classList.add('hidden');
    }
})

document.getElementById('cerrar-modal-add-cliente').addEventListener('click', () => {

    document.getElementById('modal-add-cliente').classList.add('hidden');

})

document.getElementById('btn-open-modal-get-geo').addEventListener('click', () => {
    const modalGeo = document.getElementById('modal-get-geo');
    modalGeo.classList.remove('hidden')
});


document.getElementById('modal-get-geo').addEventListener('click', e => {
    if (e.target == document.getElementById('modal-get-geo')) {
        document.getElementById('modal-get-geo').classList.add('hidden')
    }
});



async function enviarCoordenadas() {
    if (!navigator.geolocation) {
        alert('Geolocation no es soportado por este navegador.');
        return;
    }

    navigator.geolocation.getCurrentPosition(async (pos) => {
        const coords = {
            lat: pos.coords.latitude,
            lng: pos.coords.longitude,
        };
        console.log(coords)
        const inputGeo = document.getElementById('geo');
        inputGeo.value = `${coords.lat}, ${coords.lng}`
        document.getElementById('modal-get-geo').classList.add('hidden');

    }, (err) => {
        console.error('Error geolocation:', err);
        alert('No se pudo obtener la ubicación: ' + err.message);
    }, {
        enableHighAccuracy: true,
        timeout: 10000,
        maximumAge: 0
    });
}

document.getElementById('get-geo').addEventListener('click', async () => {
    await enviarCoordenadas();
});



document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('imagen');
    const preview = document.getElementById('preview');
    const removeBtn = document.getElementById('remove-preview');
    const imageCont = document.getElementById('image-cont')
    const previewCont = document.getElementById('preview-cont')

    input.addEventListener('change', (e) => {

        imageCont.classList.add('hidden');
        previewCont.classList.remove('hidden')
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (event) => {
            preview.src = event.target.result;
        };
        reader.readAsDataURL(file);
    });

    removeBtn.addEventListener('click', () => {
        imageCont.classList.remove('hidden');
        previewCont.classList.add('hidden')
        preview.src = ""; // vuelve a la imagen por defecto
        input.value = ''; // limpia el input file
    });
});


document.getElementById('add-cliente-form').addEventListener('submit', async e => {
    e.preventDefault();
    const nombre = document.getElementById('nombre').value
    const correo = document.getElementById('correo').value
    const telefono = document.getElementById('telefono').value
    const direccion = document.getElementById('direccion').value
    const geo = document.getElementById('geo').value
    const imagen = document.getElementById('imagen').files[0] ?? null;
    // const activo = document.getElementById('activo').checked;
    const referencia = document.getElementById('referencia').value;
    const nroCi = document.getElementById('nro_ci').value;
    const ciudad = $('ciudad').value;

    const formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('correo', correo);
    formData.append('telefono', telefono);
    formData.append('direccion', direccion);
    formData.append('geo', geo);
    imagen != null ? formData.append('imagen', imagen) : '';
    // formData.append('activo', activo ? 1 : 0);
    formData.append('referencia', referencia);
    formData.append('nro_ci', nroCi);
    formData.append('ciudad', ciudad);

    try {
        const res = await fetch('/api/cliente', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            body: formData,
        })

        const data = await res.json();
        document.getElementById('add-cliente-form').reset();
        if (imagen) {
            imagen.value = "";
        }
        document.getElementById('modal-add-cliente').classList.add('hidden')
        await renderClientes();
        showToast('Cliente Agregado correctamente!');
        console.log(data)
    } catch (err) {
        showToast(`${err.error}`)
        console.log(err)
    }
})


export async function renderClientes() {
    try {
        const res = await axios.get('api/cliente');
        const data = res.data.data;
        console.log(res);
        const cont = $('clientes-container');
        cont.innerHTML = '<h2>Clientes</h2>';

        let count = 0;
        for(const cliente of data) {
            if(count == 4) break;
            const telefono = cliente.telefono ?                
                ` <p class="text-sm text-gray-500 mt-1">
                📞 ${cliente.telefono}
                </p>` : '';
             

            const activo = cliente.activo ? 
                `<span class="px-2 py-1 mt-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Activo</span>` : '';


            const correo = cliente.correo ? 
                `<p class="text-sm text-gray-500">📧 ${cliente.correo ?? 'Sin correo'}</p>` : '';

            const div = document.createElement('div');
            div.className = 'flex items-center bg-gray-100 rounded-2xl shadow-md mb-2 p-2 hover:shadow-lg transition cursor-pointer';
            div.innerHTML = `
                <div class="w-22 h-24 rounded-xl overflow-hidden flex-shrink-0 bg-white">
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

            cont.appendChild(div);
            count++;
        }

    } catch (err) {
        console.log(err)
    }
}