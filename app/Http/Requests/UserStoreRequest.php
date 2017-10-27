<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'firstName' => 'required',
            'lastName' => 'required',
            'mobile' => 'required|min:10',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            //'cpassword' => 'required|min:6',
        ];
    }

    /*public function messages()
    {
        return [
            'first_name.required' => 'A title is required',
            'body.required'  => 'A message is required',
        ];
    }*/
}
