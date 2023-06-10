<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateModeratorRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if($request->password != null){
            return [
                'email' =>['required','email', Rule::unique('users')->ignore( (int)$request->user_id)],
                'password' => 'min:8|max:200',
                'phone' => ['required','max:200', Rule::unique('users')->ignore( (int)$request->user_id)] ,
            ];
        }else{
            return [
                'email' =>['required','email', Rule::unique('users')->ignore( (int)$request->user_id)],
                'phone' => ['required','max:200', Rule::unique('users')->ignore( (int)$request->user_id)] ,
            ];
        }
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
