<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role == 'cobrador';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */


    public function rules(): array
    {
        return [
            'nombre' => 'sometimes',
            'correo' => [
                'sometimes',
                'email',
                Rule::unique('clientes', 'correo')->ignore($this->cliente_id, 'id')
            ],
            'telefono' => [
                'sometimes',
                'numeric',
                Rule::unique('clientes', 'telefono')->ignore($this->telefono, 'telefono')
            ],
            'direccion' => 'sometimes',
            'geo' => 'sometimes',
            'imagen' => 'sometimes',
            'activo' => 'sometimes',
            'referencia' => 'sometimes',
            'nro_ci' => 'sometimes',
            'ciudad' => 'sometimes',
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
