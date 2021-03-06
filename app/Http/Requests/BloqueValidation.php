<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BloqueValidation extends FormRequest
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
            'nombre'=>'required',
            'filas'=>'required|numeric|min:1'
            // 'nombre'=>Rule::unique('bloque')->ignore($bloque->id, 'id'),
        ];
    }
}
