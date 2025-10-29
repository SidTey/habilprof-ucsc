<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHabilitacionRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'rut_alumno'             => 'required|integer|min:1000000|max:60000000|digits_between:7,8',
            'tipo_habilitacion'      => 'required|in:PrIng,PrInv,PrTut',
            'descripcion_habilitacion' => 'required|string|min:50|max:500',
        ];
    }
}
