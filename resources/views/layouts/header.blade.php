<div
    class="relative flex justify-between bg-gradient-to-r shadow-sm from-gray-100 to-gray-200 text-green-700 p-4 md:flex md:justify-between md:items-center">
    <div>
        <h1 class="text-lg font-bold">¡Buenos días, {{ auth()->user()->name }}!</h1>
        <p class="text-green-500 text-sm">Hoy: {{ now()->format('d-m-Y') }}</p>
    </div>
    <button id="abrir-drop-opciones"
        class="cursor-pointer text-white bg-green-400 bg-opacity-20 px-3 py-3 rounded-full mt-2 md:mt-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
        </svg>
    </button>

    <div id="drop-opciones"
        class="hidden absolute z-50 bg-gray-500 top-22 right-4 rounded-md text-white py-3 px-4 font-semibold  items-center gap-2 cursor-pointer ">
        <div id="opciones-animation" class="w-full animate-modal-in">
            <div class="flex gap-2 items-center mx-auto justify-center mb-4">
                <p>Perfil</p>
                <i>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>

                </i>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="cursor-pointer flex items-center gap-2 mx-auto justify-center transition active:scale-90">
                    <p>Cerrar sesion</p>
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>

                    </i>
                </button>
            </form>
        </div>
    </div>
</div>


<script type="module">
    const modal = document.getElementById('drop-opciones');
    const div = document.getElementById('opciones-animation');
    const btn = document.getElementById('abrir-drop-opciones')
    btn.addEventListener('click', () => {
        if (btn.id == 'abrir-drop-opciones') {
            modal.classList.remove('hidden');
            if (div.classList.contains('animate-modal-out')) {
                div.classList.replace('animate-modal-out', "animate-modal-in");
            }
            btn.id = 'cerrar-drop-opciones'
        } else {
            modal.classList.add('hidden');
            if (div.classList.contains('animate-modal-out')) {
                div.classList.replace('animate-modal-out', "animate-modal-in");
            }
            btn.id = 'abrir-drop-opciones'
        }
    })
</script>
