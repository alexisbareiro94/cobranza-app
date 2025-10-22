@extends('layouts.guest')

@section('title', 'Login')

@section('content')

    <div class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 w-full max-w-md overflow-hidden">
            <!-- Header con identidad de cobrador -->
            <div class="bg-gradient-to-r from-green-700 to-emerald-800 py-5 px-6 text-center">
                <div class="flex justify-center mb-2">
                    <i class="fas fa-house-user text-white text-2xl"></i>
                </div>
                <h1 class="text-xl font-bold text-white">Iniciar Sesión</h1>
                <p class="text-green-100 text-sm mt-1">Accede a tus rutas y clientes del día</p>
            </div>

            <!-- Formulario de login -->
            <form class="px-6 py-6 space-y-5" method="POST" action="{{ route('login.post') }}">
                @csrf
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-800 mb-1">
                        <i class="fas fa-envelope mr-2 text-gray-600"></i>Correo electrónico
                    </label>
                    <input type="email" name="email" id="email" placeholder="tu.correo@empresa.com"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                        required />
                </div>

                <!-- Contraseña -->
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label for="password" class="block text-sm font-medium text-gray-800">
                            <i class="fas fa-lock mr-2 text-gray-600"></i>Contraseña
                        </label>
                        <a href="#" class="text-xs text-green-600 hover:text-green-800">¿Olvidaste tu contraseña?</a>
                    </div>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                        required />
                </div>

                <!-- Recordarme -->
                <div class="flex items-center">
                    <input type="checkbox" id="remember" class="h-4 w-4 text-green-600 rounded focus:ring-green-500" />
                    <label for="remember" class="ml-2 text-sm text-gray-700">Mantener sesión activa</label>
                </div>

                <!-- Botón de acceso -->
                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 rounded-lg shadow transition duration-200 flex items-center justify-center">
                    <i class="fas fa-door-open mr-2"></i> Ingresar al sistema
                </button>

                <!-- Nota contextual -->
                <p class="text-xs text-gray-500 text-center mt-3">
                    Tu trabajo comienza aquí: rutas, deudas pendientes y clientes por visitar.
                </p>
                <p class=" text-gray-500 text-center mt-3">
                    Nuevo? <a href="{{ route('register') }}" class="text-green-600 text-lg"> Regístrate!</a>
                </p>
            </form>
        </div>
    </div>
@endsection
