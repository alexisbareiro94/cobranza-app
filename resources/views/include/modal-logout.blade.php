<!-- Modal de Confirmación de Logout -->
<div id="modal-logout" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black/40">
    <div id="logout-animate" class="relative p-4 w-full max-w-md animate-modal-in">
        <!-- Modal content -->
        <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Modal header -->
            <div class="bg-red-50 p-4 border-b border-red-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-red-700 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                        Confirmar Cierre de Sesión
                    </h3>
                    <button id="cerrar-modal-logout"
                        class="text-red-700 hover:bg-red-200 rounded-full w-8 h-8 flex items-center justify-center transition">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Cerrar</span>
                    </button>
                </div>
            </div>

            <!-- Modal body -->
            <div class="p-6">
                <div class="text-center mb-6">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-10 h-10 text-red-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">¿Estás seguro que deseas cerrar sesión?</h3>
                    <p class="text-sm text-gray-600">
                        Se cerrará tu sesión actual y tendrás que volver a iniciar sesión para acceder al sistema.
                    </p>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3">
                    <button id="cancelar-logout"
                        class="flex-1 px-4 py-2.5 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition">
                        Cancelar
                    </button>
                    <form method="POST" action="{{ route('logout') }}" class="flex-1">
                        @csrf
                        <button type="submit"
                            class="w-full px-4 py-2.5 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Abrir modal de logout
    const btnLogoutDesktop = document.getElementById('btn-logout-desktop');
    const btnLogoutMobile = document.getElementById('btn-logout-mobile');
    const modalLogout = document.getElementById('modal-logout');
    const btnCerrarModalLogout = document.getElementById('cerrar-modal-logout');
    const btnCancelarLogout = document.getElementById('cancelar-logout');

    function abrirModalLogout() {
        modalLogout.classList.remove('hidden');
        document.getElementById('logout-animate').classList.add('animate-modal-in');
    }

    function cerrarModalLogout() {
        document.getElementById('logout-animate').classList.remove('animate-modal-in');
        document.getElementById('logout-animate').classList.add('animate-modal-out');
        setTimeout(() => {
            modalLogout.classList.add('hidden');
            document.getElementById('logout-animate').classList.remove('animate-modal-out');
        }, 200);
    }

    if (btnLogoutDesktop) {
        btnLogoutDesktop.addEventListener('click', (e) => {
            e.preventDefault();
            abrirModalLogout();
        });
    }

    if (btnLogoutMobile) {
        btnLogoutMobile.addEventListener('click', (e) => {
            e.preventDefault();
            abrirModalLogout();
        });
    }

    if (btnCerrarModalLogout) {
        btnCerrarModalLogout.addEventListener('click', cerrarModalLogout);
    }

    if (btnCancelarLogout) {
        btnCancelarLogout.addEventListener('click', cerrarModalLogout);
    }

    // Cerrar al hacer clic fuera del modal
    window.addEventListener('click', (event) => {
        if (event.target === modalLogout) {
            cerrarModalLogout();
        }
    });
</script>
