<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrogotPasswordAddNewPasswordRequest extends FormRequest
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
            'code' => 'required',
            'password' => 'min:8|max:254|required',
            'password_confirmation' => 'required_with:password|same:password|min:8|max:254'
        ];
    }

    public function messages() {

        return [
            'password.required' => 'обязательное поле',
            'code.required' => 'обязательное поле',
            'password.min' => 'поле должно состоять из 8-и символов',
            'password_confirmation.required_with' => 'пароль не совпадает',
            'password_confirmation.same' => 'пароль не совпадает',
            'password_confirmation.min' => 'поле должно состоять из 8-и символов',
        ];
    }
}
