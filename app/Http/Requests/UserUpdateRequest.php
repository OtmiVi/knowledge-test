<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email'     => 'required|min:3|max:75|',
            'password'  => 'required|min:6|max:75|',
            'user_type' => 'min:3|max:50|'
        ];
    }
}
