<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validateSpecialty extends FormRequest
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
            'name' => 'min:3|required',
            'description' => 'min:5 | required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'el nombre es obligatorio',
            'name.min' => 'El nombre debe tener como minimo 3 caracteres',
            'description.required' => 'la descripcion es obligatorio',
            'description.min' => 'La descripcion debe tener como minimo 5 caracteres',

        ];
    }
}
