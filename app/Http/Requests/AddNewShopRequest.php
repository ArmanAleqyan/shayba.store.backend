<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddNewShopRequest extends FormRequest
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
            'name' => 'required|max:200',
            'email' => 'unique:users|required|email|',
            'password' => 'required|min:8|max:200',
            'phone' => 'unique:users|required|max:200',
//            'shop_id' => 'unique:users'
        ];
    }



    public function messages() {

        return [
        'name.required' => 'обязательное поле',
        'email.required' => 'обязательное поле',
        'password.required' => 'обязательное поле',
        'phone.required' => 'обязательное поле',
        'shop_id.unique' => 'Такое ID уже существует',
        'email.unique' => 'пользователь с такими данными уже существует',
        'phone.unique' => 'пользователь с такими данными уже существует',
        'password.min' => 'поле должно состоять из 8-и символов'
];
    }




}
