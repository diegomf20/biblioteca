<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LibroValidation extends FormRequest
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
            'codigo'            => 'required',
            'fecha_publicacion' => 'required',
            'titulo'            => 'required',
            'autor'             => 'required',
            'categoria_id'      => 'required',
            'bloque_id'         => 'required',
            'fila'              => 'required|numeric',
            'unidad'            => 'required|numeric',
            'descripcion'       => '',
        ];

    }
}
