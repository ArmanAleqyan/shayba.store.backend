<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewModeratorRequest extends FormRequest
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
            'email' => 'unique:users|required|email|',
            'password' => 'required|min:8|max:200',
            'phone' => 'unique:users|required'
        ];
    }
    public function messages() {

        return [
            'name.required' => 'обязательное поле',
            'email.required' => 'обязательное поле',
            'password.required' => 'обязательное поле',
            'phone.required' => 'обязательное поле',
            'shop_id.required' => 'обязательное поле',
            'email.unique' => 'пользователь с такими данными уже существует',
            'phone.unique' => 'пользователь с такими данными уже существует',
            'password.min' => 'поле должно состоять из 8-и символов'
        ];
    }


}
