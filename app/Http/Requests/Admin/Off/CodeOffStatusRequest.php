<?php

namespace App\Http\Requests\Admin\Off;

use Illuminate\Foundation\Http\FormRequest;

class CodeOffStatusRequest extends FormRequest
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
            "min_price" => "required|integer" ,
            "off_price" => "required|integer" ,
            "period" => "required|integer" ,
            "status" => "required|numeric|in:0,1"
        ];
    }


    public function attributes(){
        return [
            "min_price" => "حداقل مبلغ سفارش",
            "off_price" => "مبلغ تخفیف",
            "period" => "مدت تخفیف",
            "status" => "وضعیت تخفیف",
        ];
    }
}
