<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracionPrestamo;
use App\Models\ConfiguracionRecibo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AjustesController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Cargar o crear configuraciones si no existen
        $configPrestamos = $user->configuracionPrestamos ?? ConfiguracionPrestamo::create([
            'user_id' => $user->id
        ]);

        $configRecibos = $user->configuracionRecibos ?? ConfiguracionRecibo::create([
            'user_id' => $user->id
        ]);

        return view('ajustes.index', [
            'user' => $user,
            'configPrestamos' => $configPrestamos,
            'configRecibos' => $configRecibos,
        ]);
    }

    public function updateProfile(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . auth()->id(),
                'telefono' => 'nullable|string|max:20',
                'nombre_negocio' => 'nullable|string|max:255',
                'direccion_oficina' => 'nullable|string|max:500',
                'horario_atencion' => 'nullable|string|max:255',
            ]);

            auth()->user()->update($validated);

            return response()->json([
                'message' => 'Perfil actualizado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $validated = $request->validate([
                'current_password' => 'required',
                'password' => ['required', 'confirmed', Password::min(8)],
            ]);

            $user = auth()->user();

            // Verificar contraseña actual
            if (!Hash::check($validated['current_password'], $user->password)) {
                return response()->json([
                    'error' => 'La contraseña actual no es correcta'
                ], 400);
            }

            $user->update([
                'password' => Hash::make($validated['password'])
            ]);

            return response()->json([
                'message' => 'Contraseña actualizada correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function updateConfigPrestamos(Request $request)
    {
        try {
            $validated = $request->validate([
                'tasa_interes_default' => 'required|numeric|min:0|max:100',
                'monto_mora_default' => 'required|integer|min:0',
                'monto_minimo' => 'required|integer|min:0',
                'monto_maximo' => 'required|integer|min:0',
                'cuotas_minimas' => 'required|integer|min:1',
                'cuotas_maximas' => 'required|integer|min:1',
                'dias_gracia' => 'required|integer|min:0',
            ]);

            $config = auth()->user()->configuracionPrestamos;

            if (!$config) {
                $validated['user_id'] = auth()->id();
                ConfiguracionPrestamo::create($validated);
            } else {
                $config->update($validated);
            }

            return response()->json([
                'message' => 'Configuración de préstamos actualizada correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function updateConfigRecibos(Request $request)
    {
        try {
            $validated = $request->validate([
                'info_contacto' => 'nullable|string',
                'mensaje_personalizado' => 'nullable|string',
                'pie_pagina' => 'nullable|string',
            ]);

            $config = auth()->user()->configuracionRecibos;

            if (!$config) {
                $validated['user_id'] = auth()->id();
                ConfiguracionRecibo::create($validated);
            } else {
                $config->update($validated);
            }

            return response()->json([
                'message' => 'Configuración de recibos actualizada correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function uploadFotoPerfil(Request $request)
    {
        try {
            $request->validate([
                'foto_perfil' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $user = auth()->user();

            // Eliminar foto anterior si existe
            if ($user->foto_perfil && Storage::disk('public')->exists($user->foto_perfil)) {
                Storage::disk('public')->delete($user->foto_perfil);
            }

            // Guardar nueva foto
            $path = $request->file('foto_perfil')->store('perfiles', 'public');

            $user->update([
                'foto_perfil' => $path
            ]);

            return response()->json([
                'message' => 'Foto de perfil actualizada correctamente',
                'path' => Storage::url($path)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function uploadLogo(Request $request)
    {
        try {
            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $config = auth()->user()->configuracionRecibos;

            if (!$config) {
                $config = ConfiguracionRecibo::create([
                    'user_id' => auth()->id()
                ]);
            }

            // Eliminar logo anterior si existe
            if ($config->logo_path && Storage::disk('public')->exists($config->logo_path)) {
                Storage::disk('public')->delete($config->logo_path);
            }

            // Guardar nuevo logo
            $path = $request->file('logo')->store('logos', 'public');

            $config->update([
                'logo_path' => $path
            ]);

            return response()->json([
                'message' => 'Logo actualizado correctamente',
                'path' => Storage::url($path)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
