import { csrfToken, url } from './utils'

let timeOut;
document.getElementById('input-buscar-cliente').addEventListener('input', e => {
    clearTimeout(timeOut);
    timeOut = setTimeout(async () => {
        const q = e.target.value.trim()
        try {
            const res = await fetch(`/api/cliente?q=${q}`);
            const data = await res.json();
            if (!res.ok) {
                throw data
            }
            renderClientes(data.data);
        } catch (err) {
        }

    }, 300);
});

function renderClientes(data) {
    const container = document.getElementById('clientes-cont')
    container.innerHTML = '';
    data.forEach(cliente => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'clientes-to-select flex flex-col cursor-pointer w-full border border-gray-300 px-2 py-2 items-center mb-2 transition-all active:scale-90 active:border-gray-800 active:rounded-md';
        button.dataset.id = cliente.id;

        button.innerHTML = `
                        <div class="flex gap-2 mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                ${cliente.nombre}
                            </span>

                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                                </svg>
                                ${cliente.nro_ci}
                            </span>
                        </div>

                        <span class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                            </svg>
                            ${cliente.telefono}
                        </span>`;

        container.appendChild(button);
    })
    setClienteId();

}


setClienteId();
function setClienteId() {
    const btns = document.querySelectorAll('.clientes-to-select');
    const clienteIdInput = document.getElementById('cliente_id');
    const clienteSelCont = document.getElementById('cliente-seleccionado-cont');
    const btnBuscarCliente = document.getElementById('btn-buscar-cliente');

    btns.forEach(btn => {
        btn.addEventListener('click', async () => {
            const id = btn.dataset.id;
            const cliente = await getCliente(id);
            clienteIdInput.value = id;
            btnBuscarCliente.innerText = 'Cambiar'
            clienteSelCont.classList.remove('hidden');
            clienteSelCont.innerHTML = ` 
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </span>                                
                                ${cliente.nombre}
                                <button id="deselect-cliente" 
                                        type="button"
                                        class="group ml-4 px-1 py-1 font-semibold bg-white border border-white active:border-gray-300 rounded-md transition active:text-red-500 active:scale-50 cursor-pointer"        
                                >   
                                    <span class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="3" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </span>
                                </button>`

            document.getElementById('modal-buscar-cliente').classList.add('hidden');

            if (document.getElementById('deselect-cliente')) {
                document.getElementById('deselect-cliente').addEventListener('click', () => {
                    clienteSelCont.classList.add('hidden');
                    clienteSelCont.innerHTML = '';
                    clienteIdInput.value = "";
                    btnBuscarCliente.innerText = 'Seleccionar Cliente'
                });
            }
        });
    });
}

async function getCliente(id) {
    try {
        const res = await fetch(`/api/cliente/${id}`);
        const data = await res.json();
        if (!res.ok) {
            throw data;
        }

        return data.data
    } catch (err) {
        console.log(err)
    }
}