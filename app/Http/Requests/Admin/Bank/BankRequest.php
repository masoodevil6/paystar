<?php

namespace App\Http\Requests\Admin\Bank;

use App\Rules\PaymentExist;
use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
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
        $rules = [
            "title" => "required|string" ,
            "status" => "required|numeric|in:0,1" ,
            "merchant_id" => "required|string" ,
            "access_token" => "nullable|string" ,
            "service_name" => ["required" , new PaymentExist()]
        ];

        if ($this->has("image_type")){
            if ($this->get("image_type") == 0){
                $rules["image_url"] = "nullable|string";
            }
            else if ($this->get("image_type") == 1){
                $rules["image_file"] = "nullable|image|mimes:png,jpg,jpeg,webp";
            }
        }

        return $rules;
    }


    public function attributes()
    {
        return [
            "title" => "عنوان بانک" ,
            "status" => "وضعیت بانک",
            "merchant_id" => "کد اعتبارسنجی",
            "access_token" => "توکن دسترسی",
            "service_name" => "کلاس درگاه",
            "image_file" => "فایل تصویر",
        ];
    }
}
