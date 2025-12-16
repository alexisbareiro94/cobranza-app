<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Z]/',      // Al menos una letra mayúscula
                'regex:/[0-9]/',      // Al menos un número
                'regex:/[@$!%*?&#]/', // Al menos un carácter especial
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El email es requerido',
            'email.email' => 'Ingrese un email válido',
            'email.unique' => 'El email: ' . $this->email . ' ya está registrado',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, un número y un carácter especial (@$!%*?&#)',
        ];
    }
}
