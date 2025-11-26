<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHistorialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->role === 'cobrador';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fecha_pago' => 'nullable|date',
            'monto' => 'nullable|numeric',
            'observaciones' => 'nullable|string',
            'estado' => 'nullable|string|in:pagado,parcial,no_pagado,pendiente',
        ];
    }

    public function messages(): array
    {
        return [
            'fecha_pago.date' => 'La fecha de pago debe ser una fecha válida.',
            'monto.numeric' => 'El monto debe ser un número.',
            'observaciones.string' => 'Las observaciones deben ser un texto.',
            'estado.in' => 'El estado debe ser "Pagado", "Parcial", "No Pagado" o "Pendiente".',
        ];
    }

    // public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    // {
    //     throw new \Illuminate\Validation\ValidationException($validator->errors());
    // }
}
