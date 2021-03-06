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
        return true;
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

    public function messages()
    {
        return[
            'libro_id.required'       => 'Seleccione un libro',
            'estudiante_id.required'  => 'Seleccione un estudiante',
        ];
    }
}
