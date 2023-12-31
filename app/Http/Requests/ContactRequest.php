<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'phone' => preg_replace('/[^0-9]/', '', $this->phone),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'company' => 'nullable',
            'email' => [
                'required',
                'regex:/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/',
            ],
            'phone' => 'required|phone:IE,UK,mobile',
            'enquiry' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A name is required.',
            'email.required' => 'An email is required.',
            'phone.required' => 'A mobile number is required.',
            'phone' => 'The is an invalid mobile number.',
        ];
    }
}
