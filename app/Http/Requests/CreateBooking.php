<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBooking extends FormRequest
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
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            'email' => [
                'required',
                'regex:/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/'
            ],
//            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'phone'       => 'phone:IE,UK,mobile',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'A name is required.',
            'surname.required' => 'A surname is required.',
            'email.required' => 'An email is required.',
            'phone.required' => 'A mobile number is required.',
            'phone' => 'The is an invalid mobile number.'
        ];
    }
}
