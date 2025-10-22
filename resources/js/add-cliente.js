import { csrfToken, showToast } from "./utils";

const $ = el => document.getElementById(el);

document.getElementById('btn-open-modal-add-cliente').addEventListener('click', () => {
    document.getElementById('modal-add-cliente').classList.remove('hidden');
});

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
    const activo = document.getElementById('activo').checked;
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
    formData.append('activo', activo ? 1 : 0);
    formData.append('referencia', referencia);
    formData.append('nro_ci', nroCi);
    formData.append('ciudad', ciudad);

    try {
        const res = await fetch('http://127.0.0.1:8000/api/cliente', {
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
        showToast('Cliente Agregado correctamente!');
        console.log(data)
    } catch (err) {
        showToast(`${err.error}`)
        console.log(err)
    }
})
