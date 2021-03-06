<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name'      => 'required|min:3|max:50|' ,
            'email'     => 'required|unique:users|min:3|max:50|',
            'password'  => 'required|min:6|max:50|',
            'user_type' => 'min:3|max:50|'
        ];
    }
}
