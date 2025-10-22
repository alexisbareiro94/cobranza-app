<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePrestramoRequest extends FormRequest
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
    protected function prepareForValidation()
    {
        $this->merge([
            'fechas' => explode(',',$this->fechas),
            // 'codigo' => set_code(),
        ]);
    }

    public function rules(): array
    {
        return [
            'cliente_id' => 'required|exists:clientes,id',
            'monto_total' => 'required|numeric',
            'monto_cuota' => 'required|numeric',
            'cantidad_cuotas' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_fin_estimado' => 'required|date',
            'rango' => 'required',
            'observaciones' => 'nullable',
            'fechas' => 'required|array',            
            // 'codigo' => 'required|unique:prestamos,codigo'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'error' => $validator->errors()
            ], 400)
        );
    }
}
