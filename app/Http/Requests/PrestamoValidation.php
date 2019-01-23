<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestamoValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // categoria
            // autor
            // titulo
            'libro_id'       => 'required',
            'estudiante_id'  => 'required',
            'fecha_prestamo' => 'required',
            'fecha_entrega'  => 'required',
        ];
    }
}
