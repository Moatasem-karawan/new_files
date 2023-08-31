<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class test extends FormRequest
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
            'name' => 'required',
            'g-recaptcha-response' => 'required|captcha',
            'email' => 'required|email',
            'message' => 'required',
            'phone' => 'required'
        ];
    }
    public function display_message()
    {
        return "Asdas";
    }
}
