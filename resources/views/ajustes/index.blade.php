@extends('layouts.app')

@section('title', 'Ajustes')

@section('content')
    <div id="ajustes-container" class="fade-in">
        <!-- Header -->
        {{-- <div class="bg-white rounded-lg shadow p-6 mb-6"> --}}
        {{-- <h2 class="text-3xl font-bold text-gray-800">Ajustes</h2> --}}
        {{-- <p class="text-gray-600 mt-1">Configura tu perfil y preferencias del sistema</p> --}}
        {{-- </div> --}}

        <!-- Tabs Navigation -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px overflow-x-auto">
                    <button data-tab="perfil"
                        class="tab-button active whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-all">
                        👤 Perfil
                    </button>
                    <button data-tab="prestamos"
                        class="tab-button whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-all">
                        💰 Préstamos
                    </button>
                    <button data-tab="recibos"
                        class="tab-button whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-all">
                        📄 Recibos
                    </button>
                    <button data-tab="password"
                        class="tab-button whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-all">
                        🔒 Contraseña
                    </button>
                </nav>
            </div>
        </div>

        <!-- Tab Content -->
        <div id="tab-content">
            <!-- Tab: Perfil del Cobrador -->
            <div id="tab-perfil" class="tab-content active">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Información Personal y del Negocio</h3>

                    <form id="form-perfil">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Foto de Perfil -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Foto de Perfil</label>
                                <div class="flex items-center space-x-4">
                                    <div class="relative">
                                        <img id="preview-foto-perfil"
                                            src="{{ $user->foto_perfil ? Storage::url($user->foto_perfil) : asset('images/default-avatar.png') }}"
                                            alt="Foto de perfil"
                                            class="w-24 h-24 rounded-full object-cover border-2 border-gray-300">
                                    </div>
                                    <div>
                                        <input type="file" id="input-foto-perfil" name="foto_perfil" accept="image/*"
                                            class="hidden">
                                        <button type="button"
                                            onclick="document.getElementById('input-foto-perfil').click()"
                                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition-all">
                                            Cambiar Foto
                                        </button>
                                        <p class="text-xs text-gray-500 mt-1">JPG, PNG. Máx 2MB</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Nombre -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre
                                    Completo*</label>
                                <input type="text" id="name" name="name" value="{{ $user->name }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email*</label>
                                <input type="email" id="email" name="email" value="{{ $user->email }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>

                            <!-- Teléfono -->
                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                                <input type="text" id="telefono" name="telefono" value="{{ $user->telefono }}"
                                    placeholder="+595 981 123 456"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>

                            <!-- Nombre del Negocio -->
                            <div>
                                <label for="nombre_negocio" class="block text-sm font-medium text-gray-700 mb-2">Nombre del
                                    Negocio</label>
                                <input type="text" id="nombre_negocio" name="nombre_negocio"
                                    value="{{ $user->nombre_negocio }}" placeholder="Mi Empresa de Cobranzas"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>

                            <!-- Dirección de Oficina -->
                            <div class="md:col-span-2">
                                <label for="direccion_oficina"
                                    class="block text-sm font-medium text-gray-700 mb-2">Dirección
                                    de Oficina</label>
                                <input type="text" id="direccion_oficina" name="direccion_oficina"
                                    value="{{ $user->direccion_oficina }}" placeholder="Av. Principal 123, Asunción"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>

                            <!-- Horario de Atención -->
                            <div class="md:col-span-2">
                                <label for="horario_atencion" class="block text-sm font-medium text-gray-700 mb-2">Horario
                                    de
                                    Atención</label>
                                <input type="text" id="horario_atencion" name="horario_atencion"
                                    value="{{ $user->horario_atencion }}" placeholder="Lunes a Viernes: 8:00 - 17:00"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition-all font-semibold">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tab: Configuración de Préstamos -->
            <div id="tab-prestamos" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Configuración de Préstamos</h3>
                    <p class="text-gray-600 mb-6">Estos valores se aplicarán por defecto al crear nuevos préstamos</p>

                    <form id="form-prestamos">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Tasa de Interés -->
                            <div>
                                <label for="tasa_interes_default" class="block text-sm font-medium text-gray-700 mb-2">Tasa
                                    de
                                    Interés por Defecto (%)*</label>
                                <input type="number" id="tasa_interes_default" name="tasa_interes_default" step="0.01"
                                    value="{{ $configPrestamos->tasa_interes_default }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>

                            <!-- Monto de Mora -->
                            <div>
                                <label for="monto_mora_default" class="block text-sm font-medium text-gray-700 mb-2">Monto
                                    de
                                    Mora por Día (Gs.)*</label>
                                <input type="number" id="monto_mora_default" name="monto_mora_default"
                                    value="{{ $configPrestamos->monto_mora_default }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>

                            <!-- Monto Mínimo -->
                            <div>
                                <label for="monto_minimo" class="block text-sm font-medium text-gray-700 mb-2">Monto
                                    Mínimo de
                                    Préstamo (Gs.)*</label>
                                <input type="number" id="monto_minimo" name="monto_minimo"
                                    value="{{ $configPrestamos->monto_minimo }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>

                            <!-- Monto Máximo -->
                            <div>
                                <label for="monto_maximo" class="block text-sm font-medium text-gray-700 mb-2">Monto
                                    Máximo de
                                    Préstamo (Gs.)*</label>
                                <input type="number" id="monto_maximo" name="monto_maximo"
                                    value="{{ $configPrestamos->monto_maximo }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>

                            <!-- Cuotas Mínimas -->
                            <div>
                                <label for="cuotas_minimas" class="block text-sm font-medium text-gray-700 mb-2">Cantidad
                                    Mínima de Cuotas*</label>
                                <input type="number" id="cuotas_minimas" name="cuotas_minimas"
                                    value="{{ $configPrestamos->cuotas_minimas }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>

                            <!-- Cuotas Máximas -->
                            <div>
                                <label for="cuotas_maximas" class="block text-sm font-medium text-gray-700 mb-2">Cantidad
                                    Máxima de Cuotas*</label>
                                <input type="number" id="cuotas_maximas" name="cuotas_maximas"
                                    value="{{ $configPrestamos->cuotas_maximas }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>

                            <!-- Días de Gracia -->
                            <div class="md:col-span-2">
                                <label for="dias_gracia" class="block text-sm font-medium text-gray-700 mb-2">Días de
                                    Gracia
                                    (antes de aplicar mora)*</label>
                                <input type="number" id="dias_gracia" name="dias_gracia"
                                    value="{{ $configPrestamos->dias_gracia }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <p class="text-xs text-gray-500 mt-1">Número de días después del vencimiento antes de
                                    aplicar
                                    mora</p>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition-all font-semibold">
                                Guardar Configuración
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tab: Personalización de Recibos -->
            <div id="tab-recibos" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Personalización de Recibos</h3>
                    <p class="text-gray-600 mb-6">Personaliza la apariencia de los recibos PDF</p>

                    <form id="form-recibos">
                        @csrf
                        <div class="space-y-6">
                            <!-- Logo -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Logo de la Empresa</label>
                                <div class="flex items-center space-x-4">
                                    <div class="relative">
                                        <img id="preview-logo"
                                            src="{{ $configRecibos->logo_path ? Storage::url($configRecibos->logo_path) : asset('images/default-logo.png') }}"
                                            alt="Logo"
                                            class="w-32 h-32 object-contain border-2 border-gray-300 rounded p-2">
                                    </div>
                                    <div>
                                        <input type="file" id="input-logo" name="logo" accept="image/*"
                                            class="hidden">
                                        <button type="button" onclick="document.getElementById('input-logo').click()"
                                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition-all">
                                            Cambiar Logo
                                        </button>
                                        <p class="text-xs text-gray-500 mt-1">JPG, PNG. Máx 2MB</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Información de Contacto -->
                            <div>
                                <label for="info_contacto"
                                    class="block text-sm font-medium text-gray-700 mb-2">Información de
                                    Contacto</label>
                                <textarea id="info_contacto" name="info_contacto" rows="3"
                                    placeholder="Teléfono: +595 981 123 456&#10;Email: contacto@empresa.com&#10;Dirección: Av. Principal 123"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">{{ $configRecibos->info_contacto }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Esta información aparecerá en el encabezado del
                                    recibo
                                </p>
                            </div>

                            <!-- Mensaje Personalizado -->
                            <div>
                                <label for="mensaje_personalizado"
                                    class="block text-sm font-medium text-gray-700 mb-2">Mensaje
                                    Personalizado</label>
                                <textarea id="mensaje_personalizado" name="mensaje_personalizado" rows="3"
                                    placeholder="Gracias por su pago puntual. Su confianza es importante para nosotros."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">{{ $configRecibos->mensaje_personalizado }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Mensaje que aparecerá en el cuerpo del recibo</p>
                            </div>

                            <!-- Pie de Página -->
                            <div>
                                <label for="pie_pagina" class="block text-sm font-medium text-gray-700 mb-2">Pie de
                                    Página</label>
                                <textarea id="pie_pagina" name="pie_pagina" rows="2"
                                    placeholder="Este recibo es válido como comprobante de pago."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">{{ $configRecibos->pie_pagina }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Texto que aparecerá al final del recibo</p>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition-all font-semibold">
                                Guardar Configuración
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tab: Cambiar Contraseña -->
            <div id="tab-password" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Cambiar Contraseña</h3>
                    <p class="text-gray-600 mb-6">Actualiza tu contraseña de acceso al sistema</p>

                    <form id="form-password">
                        @csrf
                        <div class="max-w-md space-y-6">
                            <!-- Contraseña Actual -->
                            <div>
                                <label for="current_password"
                                    class="block text-sm font-medium text-gray-700 mb-2">Contraseña
                                    Actual*</label>
                                <input type="password" id="current_password" name="current_password" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>

                            <!-- Nueva Contraseña -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Nueva
                                    Contraseña*</label>
                                <input type="password" id="password" name="password" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <p class="text-xs text-gray-500 mt-1">Mínimo 8 caracteres</p>
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700 mb-2">Confirmar
                                    Nueva Contraseña*</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition-all font-semibold">
                                Cambiar Contraseña
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/ajustes.js') }}"></script>
@endsection
