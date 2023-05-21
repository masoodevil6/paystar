<?php

namespace App\Http\Requests\Customer\Order;

use App\Rules\PaymentExist;
use Illuminate\Foundation\Http\FormRequest;

class RequestPaymentRequest extends FormRequest
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
            "code_off" => "nullable|string" ,
            "class_name" => ["required" , new PaymentExist()]
        ];
    }


    public function attributes()
    {
        return [
            "code_off" => "کد تخفیف",
            "class_name" => "درگاه پرداخت",
        ];
    }
}
