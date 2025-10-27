import mapboxgl from 'mapbox-gl';
import { MAPBOX_TOKEN } from './utils';
import axios from 'axios';
mapboxgl.accessToken = MAPBOX_TOKEN;

let userCoords;
let map; // 👈 definimos map aquí para usarlo en cualquier parte

async function initMapa() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            async (position) => {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;
                userCoords = [userLng, userLat];

                map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/streets-v12',
                    center: [userLng, userLat],
                    zoom: 12
                });

                map.addControl(new mapboxgl.NavigationControl());

                const userMarkerEl = document.createElement('div');
                userMarkerEl.style.width = '20px';
                userMarkerEl.style.height = '20px';
                userMarkerEl.style.backgroundColor = 'blue';
                userMarkerEl.style.borderRadius = '50%';
                userMarkerEl.style.border = '3px solid white';
                userMarkerEl.style.boxShadow = '0 0 10px rgba(0,0,0,0.5)';
                userMarkerEl.style.cursor = 'pointer';

                new mapboxgl.Marker({ element: userMarkerEl })
                    .setLngLat([userLng, userLat])
                    .setPopup(new mapboxgl.Popup({ offset: 25 }).setText("Tu ubicación"))
                    .addTo(map);

                await getRutas(map);
            },
            (error) => {
                console.error("No se pudo obtener la ubicación:", error);
                defaultMapa();
            }
        );
    } else {
        console.error("Geolocation no soportada");
        defaultMapa();
    }
}

document.getElementById('btnUbicacion').addEventListener('click', () => {
    if (map && userCoords) {
        map.flyTo({
            center: userCoords,
            zoom: 18,
            speed: 1.5,
            curve: 1.2
        });
    } else {
        alert('Ubicación no disponible aún.');
    }
});

function defaultMapa() {
    map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [-57.65, -25.30],
        zoom: 12
    });

    map.addControl(new mapboxgl.NavigationControl());
    getRutas(map);
}

async function getRutas(map) {
    try {
        const res = await axios.get('/api/ruta');
        const coordenadas = res.data.data;

        coordenadas.forEach(punto => {
            const popupContent = `
                <div>
                    <strong>${punto.cliente}</strong><br/>
                    <a href="https://www.google.com/maps/search/?api=1&query=${punto.lat},${punto.lng}" 
                       target="_blank" 
                       style="display:inline-block;margin-top:5px;padding:4px 8px;background:#007bff;color:white;text-decoration:none;border-radius:4px;">
                       Ir con Google Maps
                    </a>
                </div>
            `;

            new mapboxgl.Marker({color: 'red'})
                .setLngLat([punto.lng, punto.lat])
                .setPopup(new mapboxgl.Popup({ offset: 25 }).setHTML(popupContent))
                .addTo(map);
        });

        const bounds = new mapboxgl.LngLatBounds();
        coordenadas.forEach(p => bounds.extend([p.lng, p.lat]));
        map.fitBounds(bounds, { padding: 80 });
    } catch (err) {
        console.log(err)
    }
}

initMapa();
