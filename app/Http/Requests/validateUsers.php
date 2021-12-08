<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validateUsers extends FormRequest
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
            'name'=>'min:3|required',
            'email'=>'required|email',
            'identity_card'=>'required|numeric',
            'address'=>'min:5|required',
            'phone'=>'numeric|required|min:7',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'el nombre es obligatorio',
            'name.min' => 'El nombre debe tener como minimo 3 caracteres',
            'email.required' => 'el email es obligatorio',
            'email.email' => 'el email no es valido',
            'identity_card.required' => 'el campo documento es obligatorio',
            'identity_card.numeric' => 'el campo documento debe tener solo numeros',
            'address.min' => 'la dirreccion debe tener como minimo 5 caracteres',
            'address.required' => 'la direccion es obligatorio',
            'phone.min' => 'el telefono  debe tener como minimo 7 caracteres',
            'phone.required' => 'la telefono  es obligatorio',
            'phone.numeric' => 'el campo telefono debe tener solo numeros',
        ];
    }
}
