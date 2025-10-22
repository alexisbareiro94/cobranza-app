@extends('layouts.guest')

@section('title', 'Registro')

@section('content')
    <section class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 w-full max-w-md overflow-hidden">
            <!-- Header con estilo de "equipo de campo" -->
            <div class="bg-gradient-to-r from-green-700 to-emerald-800 py-5 px-6 text-center">
                <div class="flex justify-center mb-2">
                    <i class="fas fa-walking text-white text-2xl"></i>
                </div>
                <h1 class="text-xl font-bold text-white">Registro de Cobrador</h1>
                <p class="text-green-100 text-sm mt-1">Tu primera herramienta para gestionar cobros en terreno</p>
            </div>

            <!-- Formulario -->
            <form class="px-6 py-6 space-y-5" action="{{ route('register.post') }}" method="POST">
                @csrf
                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-800 mb-1">
                        <i class="fas fa-user mr-2 text-gray-600"></i>Nombre completo
                    </label>
                    <input type="text" id="name" name="name" placeholder="Ej. Carlos Mendoza"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-800 mb-1">
                        <i class="fas fa-envelope mr-2 text-gray-600"></i>Correo electrónico
                    </label>
                    <input type="email" id="email" name="email" placeholder="carlos.m@cobranzas.com"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" />
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-800 mb-1">
                        <i class="fas fa-lock mr-2 text-gray-600"></i>Contraseña
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="••••••••"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" />

                        <span id="show-password"
                            class="absolute z-50 top-1.5 right-1 cursor-pointer  hover:bg-gray-200 px-2 py-1 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </span>

                        <span id="hide-password"
                            class="hidden absolute z-50 top-1.5 right-1 cursor-pointer hover:bg-gray-200 px-2 py-1 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </span>

                    </div>
                </div>

                <!-- Botón de registro -->
                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 rounded-lg shadow transition duration-200 flex items-center justify-center">
                    <i class="fas fa-sign-in-alt mr-2"></i> Registrarme como cobrador
                </button>

                <!-- Nota contextual -->
                <p class="text-xs text-gray-500 text-center mt-4">
                    Al registrarte, podrás gestionar tus rutas, clientes y cobros desde tu celular.
                </p>
                <p class="text-sm text-gray-500 text-center mt-4">
                    Ya tienes una cuenta? <a href="{{ route('login') }}"> Inicia sesion!</a>
                </p>
            </form>
        </div>
    </section>


    <script>
        document.getElementById('show-password').addEventListener('click', () => {
            const showPass = document.getElementById('show-password')
            const hidePass = document.getElementById('hide-password');
            const input = document.getElementById('password');

            input.type = 'text';
            showPass.classList.add('hidden');
            hidePass.classList.remove('hidden');
        })

        document.getElementById('hide-password').addEventListener('click', () => {
            const showPass = document.getElementById('show-password')
            const hidePass = document.getElementById('hide-password');
            const input = document.getElementById('password');

            input.type = 'password'
            hidePass.classList.add('hidden');
            showPass.classList.remove('hidden');
        })
    </script>
@endsection
