<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->role == 'cobrador';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string',
            'correo' => 'required|email|unique:clientes,correo',
            'telefono' => 'required|numeric',
            'direccion' => 'required|string',
            'geo' => 'required',
            'imagen' => 'nullable|image',
            'activo' => 'required|boolean',
            'referencia' => 'nullable',
            'nro_ci' => 'required|numeric|unique:clientes,nro_ci',
            'ciudad' => 'required|numeric|min:1|max:19'
        ];
    }
}
