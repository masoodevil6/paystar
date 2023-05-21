<?php

namespace App\Http\Requests\Auth\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginAdminRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "userEmail" => "required" ,
            "password" => "required" ,
        ];
    }

    public function attributes()
    {
        return [
            "userEmail" => "ایمیل کاربری" ,
            "password" => "رمز عبور" ,
        ];
    }
}
