<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstudianteValidation extends FormRequest
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
            'nombre'=>'required|min:3',
            'apellido'=>'required|min:3',
            'fecha_vence'=>'required',
            'telefono'=>'required|numeric|between:100000000,999999999',
        ];
    }
    public function messages()
    {
        return [
            'telefono.min'=>'Debe de tener 9 caracteres',
            'telefono.max'=>'Debe de tener 9 caracteres',
            'telefono.between'=>'Debe de tener 9 caracteres',
        ];
    }

    
}
